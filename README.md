Humus AMQP Demo Module
=================

This is a demo module for [Humus AMQP Module](https://github.com/prolic/HumusAmqpModule).

About
-----

Install this module to enable some demo consumers and producers as a start to learn with RabbitMQ.

Dependencies
------------

 - PHP 5.3.23
 - [HumusAmqpModule](https://github.com/prolic/HumusAmqpModule)
 - [php-amqplib](https://github.com/videlalvaro/php-amqplib)

Installation
------------

 1.  Add `"prolic/humus-amqp-demo-module": "dev-master"` to your `composer.json`
 2.  Run `php composer.phar install`
 3.  Enable the module in your `config/application.config.php` by adding `HumusAmqpDemoModule` to `modules`

Usage
-----

Setup Fabric

    php public/index.php amqp setup-fabric

Start the demo consumer

    php public/index.php amqp consumer demo-consumer

Send a message from StdIn to exchange

    echo "my test message" | xargs -0 php public/index.php amqp stdin-producer demo-producer

Send a message from parameter to exchange

    php public/index.php amqp stdin-producer demo-producer "my test message"
