<?php

namespace HumusAmqpDemoModule\Demo;

use AMQPEnvelope;
use AMQPQueue;
use HumusAmqpModule\ConsumerInterface;

class EchoErrorCallback
{
    /**
     * @param AMQPMessage $msg The message
     * @param AMQPQueue $queue
     * @return ConsumerInterface::MSG_ACK
     */
    public function __invoke(AMQPMessage $msg, AMQPQueue $queue)
    {
        echo 'ERROR: ' . $msg->getBody() . "\n";
        return ConsumerInterface::MSG_ACK;
    }
}
