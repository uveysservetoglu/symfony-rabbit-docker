<?php

namespace App\Controller;

use App\Entity\Product;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation as Rest;

class ProductController extends BaseController
{

    /**
     * @Rest\Route("/product", name="list-product", methods={"GET"})
     * @return JsonResponse
     */
    public function listProduct() {

        $em = $this->container->get('doctrine')->getManager();
        $product = $em->getRepository(Product::class)->findAll();

        $serializer =  (new SerializerBuilder())->create()->build();
        $jsonContent = $serializer->serialize($product, 'json');

        return $this->get('app.api_response')->responseJson(
            json_decode($jsonContent),
            'msg.success.deleted',
            null,
            200
        );
    }

    /**
     * @Rest\Route("/product", name="created-product", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function postProduct(Request $request) {

        $requestPost = json_decode($request->getContent());

        $valid = ["quantity", "price", "discountPrice", "sku", "name"];

        if(count($validation = parent::validation($valid,$requestPost)) > 0)
            return $this->get('app.api_response')->responseJson($validation,'msg.error.required', null, 404);

        $this->get('old_sound_rabbit_mq.product_producer')->publish(json_encode($requestPost));

        return $this->get('app.api_response')->responseJson(
            $requestPost,
            'msg.success.create',
            null,
            200
        );
    }


    /**
     * @Rest\Route("/product/{id}", name="updated-product", methods={"PUT"})
     * @param Request $request
     * @return JsonResponse
     */
    public function putProduct(Request $request, $id) {

        $productBody = json_decode($request->getContent());

        $valid = ["quantity", "price", "discountPrice", "sku", "name"];

        if(count($validation = parent::validation($valid,$productBody)) > 0)
            return $this->get('app.api_response')->responseJson($validation,'msg.error.required', null, 404);


        $em = $this->container->get('doctrine')->getManager();

        $product = $em->getRepository(Product::class)->find($id);

        $product->setCanonical($productBody->canonical);
        $product->setMetaDescription($this->get('app.translate')->translate($productBody->metaDescription, 'tr', ['en']));
        $product->setMetaKeywords($productBody->metaKeywords);
        $product->setDescription($this->get('app.translate')->translate($productBody->description, 'tr', ['en']));
        $product->setName($productBody->name);
        $product->setDiscountPrice($productBody->discountPrice);
        $product->setPrice($productBody->price);
        $product->setQuantity($productBody->quantity);
        $product->setSku($productBody->sku);
        $product->setUrlKey($productBody->urlKey);


        $em->persist($product);
        $em->flush();

        return $this->get('app.api_response')->responseJson(
            $productBody,
            'msg.success.updated',
            null,
            200
        );
    }

    /**
     * @Rest\Route("/product/{id}", name="deleted-product", methods={"DELETE"})
     * @return JsonResponse
     */
    public function deleteProduct($id) {

        $em = $this->container->get('doctrine')->getManager();

        $product = $em->getRepository(Product::class)->find($id);

        $em->remove($product);
        $em->flush();

        return $this->get('app.api_response')->responseJson(
            null,
            'msg.success.deleted',
            null,
            200
        );
    }
}
