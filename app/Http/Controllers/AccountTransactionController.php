<?php

namespace App\Http\Controllers;

use App\Models\AccountTransaction;
use Illuminate\Support\Facades\Auth;

class AccountTransactionController extends Controller
{
    /**
     * Summary of index
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $accountTrans = AccountTransaction::with(['account.category'])->where('user_id', Auth::id())->get();

        return view('pages.account-trans', compact(['accountTrans']));
    }
}