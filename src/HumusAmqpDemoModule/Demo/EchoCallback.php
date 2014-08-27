<?php

namespace HumusAmqpDemoModule\Demo;

use AMQPEnvelope;
use AMQPQueue;

class EchoCallback
{
    /**
     * @param AMQPEnvelope $msg The message
     * @param AMQPQueue $queue
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function __invoke(AMQPEnvelope $msg, AMQPQueue $queue)
    {
        echo $msg->getBody() . "\n";
    }
}
