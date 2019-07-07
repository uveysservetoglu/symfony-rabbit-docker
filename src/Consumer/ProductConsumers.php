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
        print_r($body);
    }
}