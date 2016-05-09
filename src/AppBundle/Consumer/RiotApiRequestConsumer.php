<?php

namespace AppBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class RiotApiRequestConsumer implements ConsumerInterface
{
    /**
     * @var resource cURL handler
     */
    private $curl;

    /**
     * @var string API endpoint
     */
    protected $apiEndpoint;

    /**
     * @var string API key
     */
    protected $apiKey;

    /**
     * Riot API rate limit. Each row in the table represents a maximum amount of requests (key) per X (value) seconds
     *
     * @var array
     */
    private $apiRateLimits = [
        10 => 10.0, // 10 requests per 10 seconds
        500 => 600.0, // 500 requests per 10 minutes
    ];

    /**
     * Array of X last request timestamps, where X is maximum key from $apiRateLimits array
     *
     * @var array
     */
    private $requestTimestamps = [];

    /**
     * Maximum request timestamp age - older timestamps will be consecutively removed
     *
     * @var int
     */
    private $requestTimestampsMaxAge;

    /**
     * Current size of buffer
     *
     * @var int
     */
    private $requestTimestampsLength = 0;

    /**
     * Buffer index offset
     *
     * @var int
     */
    private $requestTimestampsOffset = 0;

    public function __construct($apiEndpoint, $apiKey)
    {
        $this->apiEndpoint = $apiEndpoint;
        $this->apiKey = $apiKey;
        ksort($this->apiRateLimits);
        $this->requestTimestampsMaxAge = max($this->apiRateLimits);
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_HEADER, true);
    }

    private function keepRate()
    {
        $now = microtime(true);
        $sleepTimestamp = $now;
        $arrayEnd = $this->requestTimestampsOffset + $this->requestTimestampsLength;
        foreach ($this->apiRateLimits as $requests => &$seconds) {
            if ($this->requestTimestampsLength >= $requests) {
                $timestamp = $this->requestTimestamps[$arrayEnd - $requests];
                $sleepTimestamp = max($seconds + $timestamp, $sleepTimestamp);
            } else {
                break;
            }
        }

        // Remove too old timestamps
        foreach ($this->requestTimestamps as $key => &$value) {
            if ($sleepTimestamp - $value > $this->requestTimestampsMaxAge) {
                unset($this->requestTimestamps[$key]);
                $this->requestTimestampsOffset++;
                $this->requestTimestampsLength--;
            }
        }
        $now = microtime(true);
        usleep(max(0, ceil(($sleepTimestamp - $now) * 1000000)));
        $this->requestTimestamps[] = $now;
        $this->requestTimestampsLength++;
    }

    private function getResult($uri)
    {
        $url = $this->apiEndpoint . $uri;
        $url .= strpos($uri, '?') === false ? '?api_key=' : '&api_key=';
        $url .= $this->apiKey;
        curl_setopt($this->curl, CURLOPT_URL, $url);
        $response = curl_exec($this->curl);
        if ($response === false) {
            $result = [
                'error' => curl_error($this->curl),
            ];
        } else {
            $header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
            $headersRaw = substr($response, 0, $header_size);
            $headers = [];
            foreach (explode("\r\n", $headersRaw) as $header) {
                $colonPosition = strpos($header, ':');
                if ($colonPosition !== false) {
                    $headers[] = [
                        trim(substr($header, 0, $colonPosition))
                        => trim(substr($header, $colonPosition + 1))
                    ];
                }
            }
            $data = substr($response, $header_size);
            $result = [
                'headers' => $headers,
                'statusCode' => curl_getinfo($this->curl, CURLINFO_HTTP_CODE),
                'data' => $data,
            ];
        }

        return $result;
    }

    public function execute(AMQPMessage $msg)
    {
        $result = null;
        $message = json_decode($msg->getBody());
        if (property_exists($message, 'url')) {
            $url = $message->url;
            $result = $this->getResult($url);
            if (array_key_exists('statusCode', $result) && $result['statusCode'] == 429) {
                sleep($result['headers']['Retry-After']);
                $result = $this->getResult($url);
            }
        }
        $this->keepRate();

        return $result;
    }
}
