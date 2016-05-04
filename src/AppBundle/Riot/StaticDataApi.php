<?php
namespace AppBundle\Riot;

use AppBundle\Entity\ParticipantTimelineData;

class StaticDataApi
{
    /**
     * @var resource cURL handler
     */
    private $curl;

    /**
     * @var string API endpoint template
     */
    protected $apiEndpointTemplate;

    /**
     * @var string API key
     */
    protected $apiKey;

    public function __construct($apiEndpoint, $apiKey)
    {
        $this->apiEndpointTemplate = $apiEndpoint;
        $this->apiKey = $apiKey;
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_VERBOSE, true);
        curl_setopt($this->curl, CURLOPT_HEADER, true);
    }

    /**
     * @param $regionId
     * @return object[]|null
     */
    public function getChampions($regionId)
    {
        //TODO Implement options for filtering returned data
        $url = sprintf(
            ($this->apiEndpointTemplate . '/api/lol/static-data/%s/v1.2/champion?locale=en_US&dataById=true&champData=image'),
            $regionId
        );

        $response = $this->getResult($url);
        if (array_key_exists('statusCode', $response) && $response['statusCode'] == 429) {
            sleep($response['headers']['Retry-After']);
            $response = $this->getResult($url);
        }
        if ($response && array_key_exists('statusCode', $response) && $response['statusCode'] == 200
            && array_key_exists('data', $response)
        ) {
            $championJsonObjects = json_decode($response['data']);
        } else {
            return $response;
        }

        return (isset($championJsonObjects->data)) ? $championJsonObjects->data : $response;
    }

    private function getResult($url)
    {
        $url .= strpos($url, '?') === false ? '?api_key=' : '&api_key=';
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
}
