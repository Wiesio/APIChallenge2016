<?php
namespace AppBundle\Riot;

use OldSound\RabbitMqBundle\RabbitMq\RpcClient;

class ApiRequestQueueCollection
{
    /**
     * @var array
     */
    protected $requestQueues;

    /**
     * ApiAbstract constructor.
     */
    public function __construct()
    {
        $this->requestQueues = [];
    }

    public function addRequestQueue($regionId, RpcClient $rpcClient, $responseQueueName)
    {
        $this->requestQueues[$regionId] = [
            'rpcClient' => $rpcClient,
            'responseQueueName' => $responseQueueName,
        ];
    }

    public function executeRequest($regionId, $url)
    {
        $response = null;
        if (isset($this->requestQueues[$regionId])) {
            /** @var RpcClient $rpcClient */
            $rpcClient = $this->requestQueues[$regionId]['rpcClient'];
            $responseQueueName = $this->requestQueues[$regionId]['responseQueueName'];
            $requestId = bin2hex(random_bytes(4));
            $rpcClient->addRequest(json_encode(['url' => $url]), $responseQueueName, $requestId);
            $replies = $rpcClient->getReplies();
            if (array_key_exists($requestId, $replies)) {
                $response = $replies[$requestId];
            }
        }

        return $response;
    }
}