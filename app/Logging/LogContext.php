<?php

namespace App\Logging;

class LogContext
{
    public static function base(array $extra = []): array
    {
        return array_merge([
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'user_agent' => request()->userAgent(),
        ], $extra);
    }
}
