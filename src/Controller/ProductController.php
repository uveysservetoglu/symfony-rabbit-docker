<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation as Rest;

class ProductController extends BaseController
{

    /**
     * @Rest\Route("/product", name="created-content", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function postProduct(Request $request) {

        $requestPost = json_decode($request->getContent());

        $valid = ["name", "description"];

        if(count($validation = parent::validation($valid,$requestPost)) > 0)
            return $this->get('app.api_response')->responseJson($validation,'msg.error.required', null, 404);


        return $this->get('app.api_response')->responseJson(
            $validation,
            'msg.success.create',
            null,
            200
        );
    }
}
