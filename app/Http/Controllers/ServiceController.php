<?php

namespace App\Http\Controllers;

use App\Services\ServiceCustomerService;

class ServiceController extends Controller
{
    /**
     * @param \App\Services\ServiceCustomerService $serviceCustomerService
     */
    public function __construct(private ServiceCustomerService $serviceCustomerService)
    {
    }

    /**
     * Show service list
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $services = $this->serviceCustomerService->getAll();

        return view('pages.service.index', compact('services'));
    }
}
