<?php

namespace App\Traits;

trait ApiResponser
{
    /**
     * @param string|null $message
     * @param int $code
     * @param array|null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(int $code,string $message = null,  array $data = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param $data
     * @param string|null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data, string $message = null, int $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
