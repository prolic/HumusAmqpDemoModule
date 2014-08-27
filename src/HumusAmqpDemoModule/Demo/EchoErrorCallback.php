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
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function __invoke(AMQPMessage $msg, AMQPQueue $queue)
    {
        echo 'ERROR: ' . $msg->getBody() . "\n";
        return ConsumerInterface::MSG_ACK;
    }
}
