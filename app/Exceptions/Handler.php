<?php

use App\Exceptions\ApiException;
use Throwable;

class Handler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ApiException) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode(),
            ], $exception->getStatusCode());
        }

        // Optional: catch all other exceptions as JSON too
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() ?: 'Something went wrong',
                'code' => method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500,
            ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500);
        }

        return $this->render($request, $exception);
    }
}
