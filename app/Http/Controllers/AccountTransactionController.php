<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

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

    public function buyNick(Request $request, $accountUuid)
    {
        $account = Account::where('uuid', $accountUuid)->first();
        $category = Category::find($account->category_id);

        if (empty($account) || empty($category) || !empty($category) && $category->status !== Category::ACTIVE_STATUS) {
            return redirect()->route('home');
        }

        if ($account->status !== Account::STATUS_AVAILABLE) {
            return redirect()->route('account.show', ['categorySlug' => $category->slug,'accountUuid' => $account->uuid]);
        }

        if ($this->checkAccoutAvailabel()) {
            $accTran = new AccountTransaction();
            $accTran->uuid = Str::uuid()->toString();
            $accTran->user_id = Auth::id();
            $accTran->account_id = $account->id;
            $accTran->price = $account->discount_price ?? $account->dprice;
            $accTran->profit_rate = Auth::user()->profit_rate;
            $accTran->order_status = AccountTransaction::ORDER_SUCCESS;
        }
    }

    /**
     * Summary of checkAccoutAvailabel
     * 
     * @return bool
     */
    public function checkAccoutAvailabel()
    {
        return true;
    }
}