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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $accountTrans = AccountTransaction::with(['account.category'])
            ->orderBy('id', 'DESC')
            ->where('user_id', Auth::id())
            ->get();

        return view('pages.account.account-trans', compact(['accountTrans']));
    }

    /**
     * Summary of buyNick
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $accountUuid
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function buyNick(Request $request, Account $account)
    {
        if ($account->status !== Account::STATUS_AVAILABLE) {
            flash()->error('Tài khoản đã có người mua!');
            return redirect()->route('home');
        }

        $category = $account->category;

        if (empty($category) || !empty($category) && $category->status !== Category::ACTIVE_STATUS) {
            flash()->error('Danh mục game hiện không hoạt động!');
            return redirect()->route('home');
        }

        $buyer = User::find(Auth::id());

        if ($account->price > $buyer->buyer_vnd) {
            flash()->error('Tài khoản bạn không đủ tiền, vui lòng nạp thêm để tiếp tục giao dịch!');
            return redirect()->route('card.index');
        }

        if ($this->checkAccoutAvailabel()) {
            $author = $account->author;
            $buyerVndAfter = $buyer->buyer_vnd - $account->price;
            $buyerVndBefore = $buyer->buyer_vnd;

            // Thực nhận của CTV
            $sellerProfit = ($account->price /100) *  $author->profit_rate;
            $buyer->buyer_vnd = $buyerVndAfter;

            // Số dư trước và sau gd của CTV
            $sellerVndAfter = $author->seller_vnd + $sellerProfit;
            $sellerVndBefore = $author->seller_vnd;
            $author->seller_vnd += $sellerProfit;

            $accTran = new AccountTransaction();
            $accTran->uuid = Str::uuid()->toString();
            $accTran->user_id = Auth::id();
            $accTran->account_id = $account->id;
            $accTran->price = $account->price;
            $accTran->profit_rate = $author->profit_rate;
            $accTran->seller_profit = $sellerProfit;

            // Số dư trước và sau gd của người mua
            $accTran->buyer_vnd_after = $buyerVndAfter;
            $accTran->buyer_vnd_before = $buyerVndBefore;

            // Số dư trước và sau gd của CTV
            $accTran->seller_vnd_before = $sellerVndBefore;
            $accTran->seller_vnd_after = $sellerVndAfter;

            $accTran->author_id = $author->id;
            $accTran->order_status = AccountTransaction::ORDER_SUCCESS;

            DB::transaction(function () use ($accTran, $author, $account, $buyer) {
                $account->status = Account::STATUS_SOLD;
                $account->save();
                $buyer->save();
                $author->save();
                $accTran->save();
            });

            flash()->success('Mua tài khoản thành công, bạn vui lòng tiến hành đổi mật khẩu!');
            return redirect()->route('account.tran.index');
        }

        flash()->error('Thông tin nick game không chính xác!');
        // Thêm trạng thái sai mật khẩu cho account
        return redirect()->route('home');
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

    /**
     * Summary of sellHistory
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function sellHistory(Request $request)
    {
        $accounts = AccountTransaction::with(['account.category'])
            ->FilterByAccountId($request->input('account_id'))
            ->where('author_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->paginate(15)
            ->withQueryString();

        return view('pages.sell-account-history', compact(['accounts']));
    }
}
