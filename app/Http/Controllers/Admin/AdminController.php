<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountTransaction;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Danh sách cộng / trừ tiền
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $balance = User::select([
            DB::raw('SUM(buyer_vnd) as total_buyer_vnd'),
            DB::raw('SUM(seller_vnd) as total_seller_vnd')
        ])->first();

        $account = Account::select(
            DB::raw('COUNT(CASE WHEN status = 1 THEN 1 END) as total_available'),
            DB::raw('COUNT(CASE WHEN status = 0 THEN 1 END) as total_hiden'),
            DB::raw('COUNT(CASE WHEN status = 2 THEN 1 END) as total_sold')
        )->first();

        $accountTransactionToday = AccountTransaction::select([
            DB::raw('SUM(price) as total_price'),
            DB::raw('SUM(profit) as total_profit')
        ])->whereDate('created_at', Carbon::today())->first();

        $accountTransaction = AccountTransaction::select([
            DB::raw('SUM(price) as total_price'),
            DB::raw('SUM(profit) as total_profit')
        ])->first();

        // Doanh thu bán nick hôm nay - card
        $todayRevenueCard = $accountTransactionToday->total_price;
        // Lợi nhuận bán nick hôm nay - vnd
        $todayRevenueCardProcessed = $accountTransactionToday->total_profit;

        // Doanh thu bán nick all - card
        $todayRevenueCardAll = $accountTransaction->total_price;
        // Lợi nhuận bán nick all - vnd
        $todayRevenueCardProcessedAll = $accountTransaction->total_profit;

        // Số dư buyer
        $buyerVnd = $balance->total_buyer_vnd;
        // Số dư seller
        $sellerVnd = $balance->total_buyer_vnd;
        
        // Tổng nick đang ẩn
        $totalRemainingNicks = $account->total_hiden;
        // Tổng số nick còn lại
        $totalRemainingNicks = $account->total_hiden;
        // Tổng số nick đã bán
        $totalNumberOfNicksSold = $account->total_sold;

        return view('pages.admin.index', compact([
            'todayRevenueCard',
            'todayRevenueCardProcessed',
            'todayRevenueCardAll',
            'todayRevenueCardProcessedAll',
            'buyerVnd',
            'sellerVnd',
            'totalRemainingNicks',
            'totalNumberOfNicksSold',
        ])); 
    }
}
