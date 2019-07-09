<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation as Rest;

class ProductController extends BaseController
{

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
            $validation,
            'msg.success.create',
            null,
            200
        );
    }
}
