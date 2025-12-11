<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse{

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function created($data = [], string $message = "Request was successful", $code = 201) : JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'errors' => []
        ], $code);
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function success($data = [], string $message = "Request was successful", $code = 200) : JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'errors' => []
        ], $code);
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function invalid($data = [], string $message = "Request contains invalid payload.", $code = 422) : JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [],
            'errors' => $data
        ], $code);
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function notFound($data = [], string $message = "Requested resource was not found on server", $code = 404) : JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [],
            'errors' => $data
        ], $code);
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function error($data = [], string $message = "Something went wrong on server", $code = 500) : JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => [],
            'errors' => $data
        ], $code);
    }

}
