<?php

namespace HumusAmqpDemoModule\Demo;

use AMQPEnvelope;
use AMQPQueue;

class PowerOfTwoCallback
{
    /**
     * @param AMQPEnvelope $msg The message
     * @param AMQPQueue $queue
     * @return int
     */
    public function __invoke(AMQPEnvelope $msg, AMQPQueue $queue)
    {
        sleep(1);
        $int = unserialize($msg->getBody());
        return pow($int, 2);
    }
}
