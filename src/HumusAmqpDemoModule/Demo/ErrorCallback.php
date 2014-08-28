<?php

namespace HumusAmqpDemoModule\Demo;

class ErrorCallback
{
    public function __invoke(\Exception $e)
    {
        throw $e;
    }
}
