<?php

namespace HumusAmqpDemoModule\Controller;

use HumusAmqpModule\ProducerInterface;
use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

class TopicProducerController extends AbstractConsoleController
{
    /**
     * @var ProducerInterface
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
            $this->producer->publish('test message', 'level.err');
        }
    }

    public function setProducer(ProducerInterface $producer)
    {
        $this->producer = $producer;
    }
}
