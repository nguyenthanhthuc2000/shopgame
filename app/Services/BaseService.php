<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class BaseService
{
    public function logWritter($channel, $message, $context = [], $level = 'debug')
    {
        $log = Log::channel($channel);

        if (!is_array($context)) {
            $context = [$context];
        }

        switch ($level) {
            case 'debug':
                $log->debug($message, $context);
                break;
            case 'error':
                $log->error($message, $context);
                break;
            default:
                $log->info($message, $context);
                break;
        }
    }
}
