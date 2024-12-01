<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AccountTransactionController extends Controller
{
    /**
     * Summary of index
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $accountTrans = AccountTransaction::with(['account.category'])
            ->where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->where('user_id', Auth::id())->get();

        return view('pages.account-trans', compact(['accountTrans']));
    }

    /**
     * Summary of buyNick
     * 
     * @param \Illuminate\Http\Request $request
     * @param mixed $accountUuid
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function buyNick(Request $request, $accountUuid)
    {
        $account = Account::with('author')->where('status', Account::STATUS_AVAILABLE)->where('uuid', $accountUuid)->first();
        
        if (empty($account)) {
            return redirect()->route('home');
        }

        $category = Category::find($account->category_id);

        if (empty($category) || !empty($category) && $category->status !== Category::ACTIVE_STATUS) {
            return redirect()->route('home');
        }

        if ($account->status !== Account::STATUS_AVAILABLE) {
            return redirect()->route('account.show', ['categorySlug' => $category->slug,'accountUuid' => $account->uuid]);
        }

        $buyer = User::find(Auth::id());
 
        if ($account->price > $buyer->buyer_vnd) {
            return redirect()->route('card.index')->withErrors([
                'error' => 'Tài khoản bạn không đủ tiền, vui lòng nạp thêm để tiếp tục giao dịch!',
            ]);
        }

        if ($this->checkAccoutAvailabel()) {
            $author = $account->author;
            $buyerVndAfter = $buyer->buyer_vnd - $account->price;
            $buyerVndBefore = $buyer->buyer_vnd;

            // Thực nhận của CTV
            $sellerProfit = ($account->price /100) *  $author->profit_rate;
            $buyer->buyer_vnd = $buyerVndAfter;
            $author->seller_vnd += $sellerProfit;

            $accTran = new AccountTransaction();
            $accTran->uuid = Str::uuid()->toString();
            $accTran->user_id = Auth::id();
            $accTran->account_id = $account->id;
            $accTran->price = $account->price;
            $accTran->profit_rate = $author->profit_rate;
            $accTran->seller_profit = $sellerProfit;
            $accTran->buyer_vnd_after = $buyerVndAfter;
            $accTran->buyer_vnd_before = $buyerVndBefore;
            $accTran->order_status = AccountTransaction::ORDER_SUCCESS;
            
            DB::transaction(function () use ($accTran, $author, $account, $buyer) {
                $account->status = Account::STATUS_SOLD;
                $account->save();
                $buyer->save();
                $author->save();
                $accTran->save();
            });

            return redirect()->route('account.tran.index')->with(['success' => 'Mua tài khoản thành công, bạn vui lòng tiến hành đổi mật khẩu!']);
        }
        
        return back()->withErrors([
            'error' => 'Tài khoản đã bán!',
        ]);
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