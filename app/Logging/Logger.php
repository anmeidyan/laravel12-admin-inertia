<?php

namespace App\Logging;

use Illuminate\Support\Facades\Log;

class Logger
{
    public static function admin(
        string $message,
        LogAction $action,
        array $context = [],
        string $level = 'info'
    ): void {
        Log::channel('admin')->{$level}(
            $message,
            LogContext::base(array_merge([
                'action' => $action->value,
                'scope' => 'admin',
            ], $context))
        );
    }

    public static function security(
        string $message,
        array $context = []
    ): void {
        Log::channel('security')->warning(
            $message,
            LogContext::base($context)
        );
    }

    public static function critical(
        string $message,
        array $context = []
    ): void {
        Log::channel('admin_stack')->critical(
            $message,
            LogContext::base($context)
        );
    }
}
