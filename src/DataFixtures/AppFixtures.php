<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $text = array('tr'=>'Bu text içeriktir', 'en' =>'Is a test message. The translation will be done.FAQ');
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setCanonical('product '.$i);
            $product->setMetaDescription(json_encode($text));
            $product->setMetaKeywords('product '.$i);
            $product->setDescription(json_encode($text));
            $product->setName('product '.$i);
            $product->setDiscountPrice(mt_rand(10, 100));
            $product->setPrice(mt_rand(10, 100));
            $product->setQuantity(mt_rand(10, 100));
            $product->setSku('product '.$i);
            $product->setUrlKey('product '.$i);
            $manager->persist($product);
        }

    }
}
