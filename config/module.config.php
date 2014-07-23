<?php

return array(
    'console' => array(
        'router' => array(
            'routes' => array(
                'humus_amqp_demo_module-topic' => array(
                    'options' => array(
                        'route' => 'amqpdemo topic-producer <amount>',
                        'defaults' => array(
                            'controller' => 'HumusAmqpDemoModule\\Controller\\TopicProducer',
                        )
                    )
                ),
                'humus_amqp_demo_module-rpc-client' => array(
                    'options' => array(
                        'route' => 'amqpdemo rpc-client <amount> [--parallel]',
                        'defaults' => array(
                            'controller' => 'HumusAmqpDemoModule\\Controller\\RpcClient',
                        )
                    )
                )
            )
        )
    ),
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
            ),
            'topic-producer' => array(
                'connection' => 'default',
                'exchange_options' => array(
                    'name' => 'topic-exchange',
                    'type' => 'topic'
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
            ),
            'topic-consumer-error' => array(
                'connection' => 'default',
                'exchange_options' => array(
                    'name' => 'topic-exchange',
                    'type' => 'topic'
                ),
                'queue_options' => array(
                    'name' => 'info-queue',
                    'routingKeys' => array(
                        '*.err'
                    )
                ),
                'callback' => 'HumusAmqpDemoModule\Demo\EchoCallback'
            ),
        ),
        'multiple_consumers' => array(
            'multiple-consumer' => array(
                'connection' => 'default',
                'exchange_options' => array(
                    'name' => 'topic-exchange',
                    'type' => 'topic'
                ),
                'queues' => array(
                    array(
                        'name' => 'multi-1',
                        'callback' => 'HumusAmqpDemoModule\Demo\EchoErrorCallback',
                        'routingKeys' => array(
                            '#.error',
                            '#.warn'
                        )
                    ),
                    array(
                        'name' => 'multi-2',
                        'callback' => 'HumusAmqpDemoModule\Demo\EchoCallback',
                        'routingKeys' => array(
                            '#.info',
                            '#.debug'
                        )
                    )
                )
            )
        ),
        'rpc_servers' => array(
            'demo-rpc-server' => array(
                'connection' => 'default',
                'callback' => 'HumusAmqpDemoModule\Demo\PowerOfTwoCallback'
            ),
            'demo-rpc-server2' => array(
                'connection' => 'default',
                'callback' => 'HumusAmqpDemoModule\Demo\RandomIntCallback'
            )
        ),
        'rpc_clients' => array(
            'demo-rpc-client' => array(
                'connection' => 'default',
                'expect_serialized_response' => true
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
        )
    ),
    'service_manager' => array(
        'invokables' => array(
            'HumusAmqpDemoModule\Demo\EchoCallback' => 'HumusAmqpDemoModule\Demo\EchoCallback',
            'HumusAmqpDemoModule\Demo\EchoErrorCallback' => 'HumusAmqpDemoModule\Demo\EchoErrorCallback',
            'HumusAmqpDemoModule\Demo\PowerOfTwoCallback' => 'HumusAmqpDemoModule\Demo\PowerOfTwoCallback',
            'HumusAmqpDemoModule\Demo\RandomIntCallback' => 'HumusAmqpDemoModule\Demo\RandomIntCallback'
        )
    ),
);
