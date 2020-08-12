<?php


namespace WikiFormConstructorBundle\Helpers\Response\Json;

use Symfony\Component\HttpFoundation\JsonResponse;

class SuccessJsonResponse
{
    static public function make($data = null, $message = '', $code = 200)
    {
        return new JsonResponse([
            'success' => true,
            'code'    => $code,
            'message' => $message,
            'data'    => $data
        ], $code);
    }
}