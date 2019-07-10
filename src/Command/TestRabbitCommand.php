<?php


namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestRabbitCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:test-rabbit')
            ->setDescription('This commands written for testing...');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        for ($i = 0; $i < 20; $i++) {

            $object = new \stdClass();

            $object->quantity       = mt_rand(10, 100);
            $object->price          = mt_rand(10, 100);
            $object->discountPrice = mt_rand(10, 100);
            $object->sku            = 'Test mesajdır'.$i;
            $object->name           = 'Test mesajdır'.$i;
            $object->urlKey        = 'Test mesajdır'.$i;
            $object->canonical      = 'Test mesajdır';
            $object->description    = 'Test mesajdır';
            $object->metaKeywords    = 'Test mesajdır';
            $object->metaDescription = 'Test mesajdır';

            $this->getContainer()->get('old_sound_rabbit_mq.product_producer')->publish(json_encode($object));
        };
    }
}