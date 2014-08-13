<?php

namespace HumusAmqpDemoModule\Controller;

use HumusAmqpModule\Amqp\Producer;
use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

class TopicProducerController extends AbstractConsoleController
{
    /**
     * @var Producer
     */
    protected $producer;

    /**
     * {@inheritdoc}
     */
    public function dispatch(RequestInterface $request, ResponseInterface $response = null)
    {
        parent::dispatch($request, $response);

        $amount = (int) $request->getParam('amount');

        for ($i = 0; $i < $amount; $i++) {
            //$this->producer->reconnect();
            $this->producer->publish('test message', 'level.err');
        }
    }

    public function setProducer(Producer $producer)
    {
        $this->producer = $producer;
    }
}
