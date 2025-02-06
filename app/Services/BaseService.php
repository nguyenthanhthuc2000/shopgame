<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class BaseService
{
    protected $logChannel = '';

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Method to set model
     */
    abstract public function setModel();

    /**
     * Get this model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * Get this log channel
     */
    public function getLogChannel(): string
    {
        return $this->logChannel;
    }

    /**
     * Method to write log
     */
    public function logWritter($message, $context = [], $level = 'debug'): void
    {
        if (!$this->logChannel) {
            return;
        }

        $log = Log::channel($this->logChannel);

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
