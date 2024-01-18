<?php

namespace App\Exceptions;

use Exception;

class MissingTokenException extends Exception
{
    public function render($request)
{
    if ($request->expectsJson()) {
        return response()->json(['error' => 'يرجى توفير الرمز المميز للوصول إلى هذا الطلب'], 401);
    }

    return redirect()->guest('login');
}
}
