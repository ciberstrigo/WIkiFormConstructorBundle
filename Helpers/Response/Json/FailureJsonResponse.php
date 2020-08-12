<?php

namespace WikiFormConstructorBundle\Helpers\Response\Json;

use Symfony\Component\HttpFoundation\JsonResponse;

class FailureJsonResponse
{
    static public function make($errors = [], $message = 'Ошибка!', $code = 500)
    {
        return new JsonResponse([
            'success' => false,
            'code'    => $code,
            'message' => $message,
            'errors'  => [
                $errors
            ],
        ], $code);
    }

    static public function makeError(\Throwable $exception)
    {
        return [
            'message' => $exception->getMessage()
        ];
    }
}