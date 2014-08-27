<?php

namespace HumusAmqpDemoModule\Demo;

use AMQPEnvelope;
use AMQPQueue;

class RandomIntCallback
{
    /**
     * @param AMQPEnvelope $msg The message
     * @param AMQPQueue $queue
     * @return int
     */
    public function __invoke(AMQPEnvelope $msg, AMQPQueue $queue)
    {
        sleep(2);
        return rand(0, 100);
    }
}
