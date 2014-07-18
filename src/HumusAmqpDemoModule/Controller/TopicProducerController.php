<?php

namespace HumusAmqpDemoModule\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

class TopicProducerController extends AbstractConsoleController
{
    protected $producer;

    /**
     * {@inheritdoc}
     */
    public function dispatch(RequestInterface $request, ResponseInterface $response = null)
    {
        parent::dispatch($request, $response);

        $amount = (int) $request->getParam('amount');

        for ($i = 0; $i < $amount; $i++) {
            $level = rand(0, 7);
            $this->producer->publish('test message', 'level.' . $level);
        }
    }

    public function setProducer($producer)
    {
        $this->producer = $producer;
    }
}
