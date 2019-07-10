<?php


namespace App\Consumer;

use App\Entity\Product;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Config\Definition\Exception\Exception;
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
        try{
            $body = $msg->getBody();
            $productBody = json_decode($body);

            $productBody->description = $this->container->get('app.translate')->translate($productBody->description, 'tr', ['en']);
            $productBody->metaDescription = $this->container->get('app.translate')->translate($productBody->metaDescription, 'tr',['en']);


            $product =  new Product();

            $product->setCanonical($productBody->canonical);
            $product->setMetaDescription($productBody->metaDescription);
            $product->setMetaKeywords($productBody->metaKeywords);
            $product->setDescription($productBody->description);
            $product->setName($productBody->name);
            $product->setDiscountPrice($productBody->discountPrice);
            $product->setPrice($productBody->price);
            $product->setQuantity($productBody->quantity);
            $product->setSku($productBody->sku);
            $product->setUrlKey($productBody->urlKey);

            $em = $this->container->get('doctrine')->getManager();

            $em->persist($product);
            $em->flush();

            $this->logger->info('Consumer Başarılı');

            echo "Consumer Başarılı".PHP_EOL;

        }catch (Exception $exception){
            throw $exception;
        }

    }
}