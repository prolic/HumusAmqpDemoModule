<?php

namespace HumusAmqpDemoModule\Demo;

use AMQPEnvelope;

class RandomIntCallback
{
    /**
     * @param AMQPEnvelope $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function __invoke(AMQPEnvelope $msg)
    {
        sleep(2);
        return rand(0, 100);
    }
}
