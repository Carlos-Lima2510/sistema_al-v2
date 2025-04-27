<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            Log::error('ValidationException capturada', ['errors' => $exception->errors()]);
            return response()->json([
                'message' => 'Error de validación.',
                'errors' => $exception->errors(),
            ], 422);
        }

        return parent::render($request, $exception);
    }
}
