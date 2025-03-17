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
    public function logWritter(string $message, array $context = [], string $level = 'debug'): void
    {
        if (!$this->logChannel) {
            return;
        }

        $log = Log::channel($this->logChannel);

        $logMethods = [
            'debug' => 'debug',
            'error' => 'error',
            'info' => 'info',
        ];

        $logMethod = $logMethods[$level] ?? 'info';
        $log->$logMethod($message, $context);
    }
}
