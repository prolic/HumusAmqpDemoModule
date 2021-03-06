Humus AMQP Demo Module
=================

This is a demo module for [Humus AMQP Module](https://github.com/prolic/HumusAmqpModule).

# ABANDONED!!!
## This module is no longer supported!

About
-----

Install this module to enable some demo consumers and producers as a start to learn with RabbitMQ.

Dependencies
------------

 - PHP 5.4.0
 - [HumusAmqpModule](https://github.com/prolic/HumusAmqpModule)

Installation
------------

 1.  Add `"prolic/humus-amqp-demo-module": "dev-master"` to your `composer.json`
 2.  Run `php composer.phar install`
 3.  Enable the module in your `config/application.config.php` by adding `HumusAmqpDemoModule` to `modules`

Usage
-----

Setup Fabric

    php public/index.php humus amqp setup-fabric

Start the demo consumer

    php public/index.php humus amqp consumer demo-consumer

Send a message from StdIn to exchange

    echo "my test message" | xargs -0 php public/index.php humus amqp stdin-producer demo-producer

Send a message from parameter to exchange

    php public/index.php humus amqp stdin-producer demo-producer "my test message"

Send 1000000 messages to topic exchange with random error-level as routing key

    php public/index.php humus amqp consumer topic-consumer-error 1000000

Consume 100 messages from topic exchange by routing key error (0)

    php public/index.php humus amqpdemo topic-producer 100

Start the multiple consumer

    php public/index.php humus amqp multiple-consumer multiple-consumer

Send messages to multiple consumer

    php public/index.php humus amqp stdin-producer topic-producer --route=level.err err
    php public/index.php humus amqp stdin-producer topic-producer --route=level.warn warn
    php public/index.php humus amqp stdin-producer topic-producer --route=level.info info
    php public/index.php humus amqp stdin-producer topic-producer --route=level.debug debug
