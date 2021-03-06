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
            ),
            'info-queue' => array(
                'name' => 'info-queue',
                'exchange' => 'topic-exchange',
                'routingKeys' => array(
                    '#.err'
                )
            )
        ),
        'connections' => array(
            'default' => array(
                'host' => 'localhost',
                'port' => 5672,
                'login' => 'guest',
                'password' => 'guest',
                'vhost' => '/',
                'persistent' => true,
                'read_timeout' => 1, //sec, float allowed
                'write_timeout' => 1, //sec, float allowed
            ),
        ),
        'producers' => array(
            'demo-producer' => array(
                'exchange' => 'demo',
                'qos' => array(
                    'prefetch_size' => 0,
                    'prefetch_count' => 10
                ),
                'auto_setup_fabric' => true
            ),
            'topic-producer' => array(
                'exchange' => 'topic-exchange',
                'auto_setup_fabric' => true
            )
        ),
        'consumers' => array(
            'demo-consumer' => array(
                'queues' => array(
                    'foo'
                ),
                'auto_setup_fabric' => true,
                'callback' => 'echo',
                'idle_timeout' => 10,
                'logger' => 'consumer-logger',
                //'error_callback' => 'errorcallback'
            ),
            'topic-consumer-error' => array(
                'queues' => array(
                    'info-queue',
                ),
                'qos' => array(
                    'prefetch_count' => 100
                ),
                'auto_setup_fabric' => true,
                'callback' => 'echo',
                'logger' => 'consumer-logger'
            ),
        ),
        'rpc_servers' => array(
            'demo-rpc-server' => array(
                'callback' => 'poweroftwo',
                'queue' => 'demo-rpc-server',
                'auto_setup_fabric' => true
            ),
            'demo-rpc-server2' => array(
                'callback' => 'randomint',
                'queue' => 'demo-rpc-server2',
                'auto_setup_fabric' => true
            )
        ),
        'rpc_clients' => array(
            'demo-rpc-client' => array(
                'queue' => 'demo-rpc-client',
                'auto_setup_fabric' => true
            )
        ),
        'plugin_managers' => array(
            'callback' => array(
                'invokables' => array(
                    'echo' => 'HumusAmqpDemoModule\Demo\EchoCallback',
                    'error' => 'HumusAmqpDemoModule\Demo\EchoErrorCallback',
                    'poweroftwo' => 'HumusAmqpDemoModule\Demo\PowerOfTwoCallback',
                    'randomint' => 'HumusAmqpDemoModule\Demo\RandomIntCallback',
                    'errorcallback' => 'HumusAmqpDemoModule\Demo\ErrorCallback'
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Log\LoggerAbstractServiceFactory'
        )
    ),
    'log' => array(
        'consumer-logger' => array(
            'writers' => array(
                array(
                    'name' => 'stream',
                    'priority' => 1000,
                    'options' => array(
                        'stream' => '/tmp/consumers.log'
                    )
                )
            )
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
