<?php

namespace HumusAmqpDemoModule\Demo;

use PhpAmqpLib\Message\AMQPMessage;

class EchoCallback
{
    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function __invoke(AMQPMessage $msg)
    {
        echo $msg->body . "\n";
    }
}
