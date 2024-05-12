<?php

declare(strict_types=1);

namespace System\Http\Response;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    public static function createJsonErrorResponse(
        string $message,
        int $status = Response::HTTP_BAD_REQUEST
    ): ResponseInterface {
        return new JsonResponse(
            [
                'status' => 'error',
                'message' => $message,
            ],
            $status
        );
    }

    public static function createJsonSuccessResponse(
        array $data = [],
        int $status = Response::HTTP_OK
    ): ResponseInterface {
        return new JsonResponse(
            [
                'status' => 'success',
                'data' => $data,
            ],
            $status
        );
    }
}
