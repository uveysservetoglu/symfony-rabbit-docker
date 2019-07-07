<?php


namespace App\Consumer;

use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpKernel\Kernel;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class ProductConsumers
 */
class ProductConsumers implements  ConsumerInterface
{

    private $container;
    private $logger;

    public function __construct(Kernel $kernel, Logger $logger)
    {
        $this->container = $kernel->getContainer();
        $this->logger = $logger;
    }

    /**
     * @var AMQPMessage $msg
     * @return void
     */
    public function execute(AMQPMessage $msg)
    {
        $body = $msg->getBody();
        $this->logger->info($body);
        print_r($body);
    }
}