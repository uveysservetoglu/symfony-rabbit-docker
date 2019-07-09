<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setCanonical('product '.$i);
            $product->setMetaDescription('"{"tr":"Test bir mesajd\ır. \Çeviri yap\ılacak.sss'.$i.'","en":"Is a test message. The translation will be done.FAQ'.$i.'"}"');
            $product->setMetaKeywords('product '.$i);
            $product->setDescription('"{"tr":"Test bir mesajd\ır. \Çeviri yap\ılacak.sss'.$i.'","en":"Is a test message. The translation will be done.FAQ'.$i.'"}"');
            $product->setName('product '.$i);
            $product->setDiscountPrice(mt_rand(10, 100));
            $product->setPrice(mt_rand(10, 100));
            $product->setQuantity(mt_rand(10, 100));
            $product->setSku('product '.$i);
            $product->setUrlKey('product '.$i);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
