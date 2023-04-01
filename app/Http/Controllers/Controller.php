<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function success($message = '', $responseData = null, int $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $responseData,
        ], $statusCode);
    }

    protected function error($exception, ?int $statusCode = null, $errorSlug = null)
    {
        $isException = $exception instanceof \Exception;
        $message = $isException ? $exception->getMessage() : $exception;

        if (!$statusCode) {
            $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 400;
        }

        return response()->json([
            'status' => 'error',
            'error' => $errorSlug,
            'message' => $message,
        ], $statusCode);
    }
}
