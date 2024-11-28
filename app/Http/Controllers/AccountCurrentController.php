<?php

namespace App\Http\Controllers;

use App\Models\AccountTransaction;
use Illuminate\Support\Facades\Auth;

class AccountCurrentController extends Controller
{
    /**
     * Summary of index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $accountCurent = AccountTransaction::with(['account.category'])->where('user_id', Auth::id())->get();

        return view('pages.account-current', compact(['accountCurent']));
    }
}
