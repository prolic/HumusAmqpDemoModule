<?php

namespace HumusAmqpDemoModule\Demo;

use HumusAmqpModule\Amqp\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class EchoErrorCallback implements ConsumerInterface
{
    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        echo 'ERROR: ' . $msg->body . "\n";
        return self::MSG_ACK;
    }
}
