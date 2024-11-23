<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\BankTransaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\BankTransactionRequest;

class BankTransactionController extends Controller
{
    /**
     * Danh sách cộng / trừ tiền
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
     * Màn hình cộng / trừ tiền
     * 
     * @param Request $request
     */
    public function create(Request $request)
    {
        return view('pages.admin.bank.create');
    }

    /**
     * Tạo giao dịch trừ công tiền
     * 
     * @param Request $request
    */
    public function store(BankTransactionRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::where('email', $request->email)->first();
            $bankTran = new BankTransaction();
            $bankTran->status = $request->status;
            $bankTran->user_id = $user->id;
            $bankTran->amount = $request->amount;
            $bankTran->buyer_vnd = $request->buyer_vnd;
            $bankTran->type = $request->type;
            $bankTran->note = $request->note;
            $bankTran->ip =  request()->ip();
            $bankTran->save();

            $user->buyer_vnd = $request->type == BankTransaction::INCREASE_TYPE ? $user->buyer_vnd + $request->buyer_vnd : $user->buyer_vnd - $request->buyer_vnd;
            $user->save();

            DB::commit();
            return redirect()->back()->with('message', "Cập nhật thành công, hãy thông báo đến khách hàng.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại sau.']);
        }
    }
}
