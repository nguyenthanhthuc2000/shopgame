<?php

namespace App\Services;

use App\Models\Service;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ServiceCustomerService extends BaseService
{
    /**
     * @var string $logChannel
     */
    protected $logChannel = 'account_transactions';

    /**
     * Set model
     */
    public function setModel(): self
    {
        $this->model = new Service;

        return $this;
    }

    /**
     * Set model
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->model->paginate();
    }

    /**
     * Delete account
     */
    public function delete(string $uuid): bool
    {
        try {
        } catch (Exception $e) {
            $this->logWritter($e->getMessage(), $e);
            return false;
        }
    }
}
