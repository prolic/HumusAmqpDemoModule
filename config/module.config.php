<?php

return array(
    'console' => array(
        'router' => array(
            'routes' => array(
                'humus_amqp_demo_module-topic' => array(
                    'options' => array(
                        'route' => 'humus amqpdemo topic-producer <amount>',
                        'defaults' => array(
                            'controller' => 'HumusAmqpDemoModule\\Controller\\TopicProducer',
                        )
                    )
                ),
                'humus_amqp_demo_module-rpc-client' => array(
                    'options' => array(
                        'route' => 'humus amqpdemo rpc-client <amount> [--parallel]',
                        'defaults' => array(
                            'controller' => 'HumusAmqpDemoModule\\Controller\\RpcClient',
                        )
                    )
                )
            )
        )
    ),
    'humus_amqp_module' => array(
        'exchanges' => array(
            'demo' => array(
                'name' => 'demo',
                'type' => 'direct',
                'arguments' => array(),
            ),
            'demo.error' => array(
                'name' => 'demo.error',
                'type' => 'direct',
                'arguments' => array(),
            ),
            'topic-exchange' => array(
                'name' => 'topic-exchange',
                'type' => 'topic',
            ),
            'demo-rpc-client' => array(
                'name' => 'demo-rpc-client',
                'type' => 'direct'
            ),
            'demo-rpc-server' => array(
                'name' => 'demo-rpc-server',
                'type' => 'direct'
            ),
            'demo-rpc-server2' => array(
                'name' => 'demo-rpc-server2',
                'type' => 'direct'
            )
        ),
        'queues' => array(
            'foo' => array(
                'name' => 'foo',
                'exchange' => 'demo', // must be defined as exchange before
                'routing_keys' => array(),
                'arguments' => array(
                    'x-dead-letter-exchange' => 'demo.error' // must be defined as exchange before
                ),
                'bind_arguments' => array(),
            ),
            'demo-rpc-client' => array(
                'name' => '',
                'exchange' => 'demo-rpc-client'
            ),
            'demo-rpc-server' => array(
                'name' => 'demo-rpc-server',
                'exchange' => 'demo-rpc-server'
            ),
            'demo-rpc-server2' => array(
                'name' => 'demo-rpc-server2',
                'exchange' => 'demo-rpc-server2'
            )
        ),
        'connections' => array(
            'default' => array(
                'host' => 'localhost',
                'port' => 5672,
                'user' => 'guest',
                'password' => 'guest',
                'vhost' => '/',
                'persistent' => true,
                'read_timeout' => 1, //sec, float allowed
                'write_timeout' => 1, //sec, float allowed
            ),
            'myconnection' => array(
                'host' => 'localhost',
                'port' => 5672,
                'user' => 'guest',
                'password' => 'guest',
                'vhost' => '/',
                'persistent' => true,
                'read_timeout' => 3, //sec, float allowed
                'write_timeout' => 1, //sec, float allowed
            )
        ),
        'producers' => array(
            'demo-producer' => array(
                'connection' => 'default',
                'exchange' => 'demo',
                'qos' => array(
                    'prefetch_size' => 0,
                    'prefetch_count' => 10
                ),
                'auto_setup_fabric' => true
            ),
            'topic-producer' => array(
                'connection' => 'default',
                'exchange' => 'topic-exchange',
                'auto_setup_fabric' => false
            )
        ),
        'consumers' => array(
            'demo-consumer' => array(
                'queues' => array(
                    'foo'
                ),
                'auto_setup_fabric' => true,
                'callback' => 'HumusAmqpDemoModule\Demo\EchoCallback',
                'timeout' => 10 //
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
        'rpc_servers' => array(
            'demo-rpc-server' => array(
                'connection' => 'default',
                'callback' => 'HumusAmqpDemoModule\Demo\PowerOfTwoCallback',
                'queue' => 'demo-rpc-server',
                'auto_setup_fabric' => true
            ),
            'demo-rpc-server2' => array(
                'connection' => 'default',
                'callback' => 'HumusAmqpDemoModule\Demo\RandomIntCallback',
                'queue' => 'demo-rpc-server2',
                'auto_setup_fabric' => true
            )
        ),
        'rpc_clients' => array(
            'demo-rpc-client' => array(
                'connection' => 'default',
                'queue' => 'demo-rpc-client',
                'auto_setup_fabric' => true
            )
        ),
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
    'humus_supervisor_module' => array(
        'listener_plugin_manager' => array(
            'factories' => array(
                'memmon' => 'HumusAmqpDemoModule\Service\MemmonListenerFactory'
            )
        ),
    )
);
