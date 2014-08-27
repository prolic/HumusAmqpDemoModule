<?php

namespace HumusAmqpDemoModule\Demo;

use AMQPEnvelope;
use AMQPQueue;

class EchoCallback
{
    /**
     * @param AMQPEnvelope $msg The message
     * @param AMQPQueue $queue
     */
    public function __invoke(AMQPEnvelope $msg, AMQPQueue $queue)
    {
        echo $msg->getBody() . "\n";
    }
}
