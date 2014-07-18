<?php

namespace HumusAmqpDemoModule\Demo;

use PhpAmqpLib\Message\AMQPMessage;

class RandomIntCallback
{
    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        return rand(0, 100);
    }
}
