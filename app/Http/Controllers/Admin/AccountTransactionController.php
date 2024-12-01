<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountTransaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\BankTransactionRequest;

class AccountTransactionController extends Controller
{
    /**
     * Danh sách cộng / trừ tiền
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $accounts = AccountTransaction::with(['user', 'account.category'])
            ->FilterByAccountId($request->input('account_id'))
            ->orderBy('id', 'DESC')
            ->paginate()
            ->withQueryString();

        return view('pages.admin.account.index', compact('accounts'));
    }
}
