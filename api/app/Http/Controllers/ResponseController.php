<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

trait ResponseController
{
    private function response(array $response): JsonResponse
    {
        return response()
            ->json(Arr::except($response, 'code'))
            ->setStatusCode($response['code']);
    }
}
