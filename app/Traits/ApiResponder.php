<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    protected function success(string $message, $data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            "status" => "Success",
            "message" => $message,
            "data" => $data,
        ], $code);
    }
    protected function error(string $message, $data = null, int $code = 400): JsonResponse
    {
        return response()->json([
            "status" => "Success",
            "message" => $message,
            "data" => $data,
        ], $code);
    }
}
