<?php

namespace App\Logging\Concerns;

use App\Logging\Logger;
use App\Logging\LogAction;

trait HasLogging
{
    protected function logAdmin(
        string $message,
        LogAction $action,
        array $context = [],
        string $level = 'info'
    ): void {
        Logger::admin($message, $action, $context, $level);
    }

    protected function logCritical(
        string $message,
        array $context = []
    ): void {
        Logger::critical($message, $context);
    }
}
