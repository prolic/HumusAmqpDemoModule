<?php

namespace HumusAmqpDemoModule\Demo;

use PhpAmqpLib\Message\AMQPMessage;

class PowerOfTwoCallback
{
    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        $int = unserialize($msg->body);
        return pow($int, 2);
    }
}
