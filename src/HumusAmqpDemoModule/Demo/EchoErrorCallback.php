<?php

namespace HumusAmqpDemoModule\Demo;

use HumusAmqpModule\Amqp\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class EchoErrorCallback
{
    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function __invoke(AMQPMessage $msg)
    {
        echo 'ERROR: ' . $msg->body . "\n";
        return ConsumerInterface::MSG_ACK;
    }
}
