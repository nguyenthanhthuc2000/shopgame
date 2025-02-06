<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\ServiceCustomerService;

class ServiceController extends Controller
{
    /**
     * @var ServiceCustomerService
     */
    protected $serviceCustomerService;
    public function __construct(ServiceCustomerService $serviceCustomerService)
    {
        $this->serviceCustomerService = $serviceCustomerService;
    }


    public function index()
    {
        $services = $this->serviceCustomerService->getAll();

        return view('pages.service.index', compact('services'));
    }
}
