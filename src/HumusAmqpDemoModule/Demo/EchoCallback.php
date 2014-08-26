<?php

namespace HumusAmqpDemoModule\Demo;

use AMQPEnvelope;

class EchoCallback
{
    /**
     * @param AMQPEnvelope $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function __invoke(AMQPEnvelope $msg)
    {
        echo $msg->getBody() . "\n";
    }
}
