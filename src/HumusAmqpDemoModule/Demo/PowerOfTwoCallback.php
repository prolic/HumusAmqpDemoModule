<?php

namespace HumusAmqpDemoModule\Demo;

use PhpAmqpLib\Message\AMQPMessage;

class PowerOfTwoCallback
{
    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function __invoke(AMQPMessage $msg)
    {
        sleep(2);
        $int = unserialize($msg->body);
        return pow($int, 2);
    }
}
