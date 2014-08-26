<?php

namespace HumusAmqpDemoModule\Demo;

use AMQPEnvelope;

class PowerOfTwoCallback
{
    /**
     * @param AMQPEnvelope $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function __invoke(AMQPEnvelope $msg)
    {
        sleep(1);
        $int = unserialize($msg->getBody());
        return pow($int, 2);
    }
}
