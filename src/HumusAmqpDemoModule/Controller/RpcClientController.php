<?php

namespace HumusAmqpDemoModule\Controller;

use HumusAmqpModule\RpcClient;
use Zend\Console\ColorInterface;
use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

class RpcClientController extends AbstractConsoleController
{
    /**
     * @var RpcClient
     */
    protected $rpcClient;

    /**
     * {@inheritdoc}
     */
    public function dispatch(RequestInterface $request, ResponseInterface $response = null)
    {
        parent::dispatch($request, $response);

        $amount = $request->getParam('amount', 1);

        if (!is_numeric($amount)) {
            return $this->getConsole()->writeLine(
                'Error: amount should be null or greater than 0',
                ColorInterface::RED
            );
        }

        for ($i = 0; $i < $amount; $i++) {
            $this->rpcClient->addRequest(serialize($i), 'demo-rpc-server', 'power of two: ' . $i);
            if ($request->getParam('parallel')) {
                $this->rpcClient->addRequest(serialize($i), 'demo-rpc-server2', 'random int: ' . $i);
            }
        }
        $replies = $this->rpcClient->getReplies();
        foreach ($replies as $key => $reply) {
            echo $key  . ' => ' . $reply . "\n";
        }
    }

    public function setRpcClient(RpcClient $rpcClient)
    {
        $this->rpcClient = $rpcClient;
    }
}
