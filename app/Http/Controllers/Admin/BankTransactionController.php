<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\BankTransactionRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\BankTransaction;
use App\Models\User;

class BankTransactionController extends Controller
{
    /**
     * List of add / subtract money
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $banks = BankTransaction::with(['user'])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('pages.admin.bank.index', compact('banks'));
    }

    /**
     * Add / subtract money page
     * 
     * @param Request $request
     */
    public function create(Request $request)
    {
        return view('pages.admin.bank.create');
    }

    /**
     * Create a transaction to subtract money
     * 
     * @param Request $request
    */
    public function store(BankTransactionRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::where('email', $request->email)->first();
            $bankTran = new BankTransaction();
            $bankTran->user_id = $user->id;
            $bankTran->amount = $request->amount;
            $bankTran->buyer_vnd = $request->buyer_vnd;
            $bankTran->type = $request->type;
            $bankTran->note = $request->note;
            $bankTran->ip =  request()->ip();
            $bankTran->save();

            $user->buyer_vnd = $request->type == BankTransaction::INCREASE_TYPE 
                ? $user->buyer_vnd + $request->buyer_vnd 
                : $user->buyer_vnd - $request->buyer_vnd;
            $user->save();
        });
        
        return redirect()->route('banks.tran.index')->with('success', "Cập nhật thành công, hãy thông báo đến khách hàng.");
    }
}
