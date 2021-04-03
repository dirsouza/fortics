<?php

namespace App\Service;

trait ReturnService
{
    /**
     * @param bool $success
     * @param string $message
     * @param object|null $data
     * @param string $code
     * @return array
     */
    private function returnData(bool $success, string $message, ?object $data, string $code): array
    {
        return [
            'success'   => $success,
            'message'   => $message,
            'data'      => is_null($data) ? $data : $data->toArray(),
            'code'      => $code
        ];
    }
}
