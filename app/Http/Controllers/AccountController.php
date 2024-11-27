<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        // $query = Account::orther();

        // if ($request->filled('searchValue')) {
        //     $query->where('account_name', 'like', '%' . $request->searchValue . '%');
        // }

        // if ($request->filled('selectedPrice')) {
        //     $query->where('account_price', $request->selectedPrice);
        // }

        // if ($request->filled('selectedOption')) {
        //     $query->where('option', $request->selectedOption);
        // }

        $accounts = Account::orderBy('id', 'DESC')
            ->paginate();
        // dd($accounts->toarray());
        return view('pages.product', compact('accounts'));
    }

    public function show($slug, $uuid)
    {
        return view('pages.detail');
    }

    public function create(Request $request)
    {
        dd($request->all());
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function edit($id)
    {
        dd($id);
    }

    public function update(Request $request, $id)
    {
        dd($id);
    }
    public function filterProducts(Request $request) {}
}