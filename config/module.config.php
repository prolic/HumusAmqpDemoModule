<?php

return array(
    'humus_amqp_module' => array(
        'connections' => array(
            'default' => array(
                'host' => 'localhost',
                'port' => 5672,
                'user' => 'guest',
                'password' => 'guest',
                'vhost' => '/',
                'lazy' => true
            )
        ),
        'producers' => array(
            'demo-producer' => array(
                'connection' => 'default',
                /* 'class' => 'MyCustomProducerClass' */
                'exchange_options' => array(
                    'name' => 'demo-exchange',
                    'type' => 'direct'
                )
            )
        ),
        'consumers' => array(
            'demo-consumer' => array(
                'connection' => 'default',
                /* 'class' => 'MyCustomConsumerClass' */
                'exchange_options' => array(
                    'name' => 'demo-exchange',
                    'type' => 'direct',
                    'passive' => false,
                    'durable' => true,
                    'auto_delete' => false,
                    'internal' => false,
                    'nowait' => false,
                    'arguments' => null,
                    'ticket' => null,
                    'declare' => true
                ),
                'queue_options' => array(
                    'name' => 'myconsumer-queue',
                    'passive' => false,
                    'durable' => true,
                    'exclusive' => false,
                    'auto_delete' => false,
                    'nowait' => false,
                    'arguments' => null,
                    'ticket' => null,
                    'routingKeys' => array(),
                ),
                'auto_setup_fabric' => true,
                'callback' => 'HumusAmqpDemoModule\Demo\EchoCallback'
            )
        )
    ),
    'service_manager' => array(
        'invokables' => array(
            'HumusAmqpDemoModule\Demo\EchoCallback' => 'HumusAmqpDemoModule\Demo\EchoCallback'
        )
    )
);
