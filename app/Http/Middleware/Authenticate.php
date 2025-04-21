<?php

namespace App\Http\Middleware;

class Authenticate
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return response()->json([
                'message' => 'No autorizado. Debes enviar un token válido.'
            ], 401);
        }
    }


}