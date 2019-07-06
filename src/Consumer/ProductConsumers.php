<?php


namespace App\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class ProductConsumers
 */
class ProductConsumers implements  ConsumerInterface
{

    /**
     * @var AMQPMessage $msg
     * @return void
     */
    public function execute(AMQPMessage $msg)
    {
        $body = $msg->getBody();
        $body = json_decode($body);


        echo '--------------'.PHP_EOL;
        print_r($body[0]);
        echo '--------------'.PHP_EOL;
        echo '--------------'.PHP_EOL;
        echo '--------------'.PHP_EOL;
    }
}