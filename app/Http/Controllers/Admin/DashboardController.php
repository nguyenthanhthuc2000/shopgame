<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\CardTransaction;
use App\Models\Admin\BankTransaction;
use App\Models\User;
use App\Models\Account;

class DashboardController extends Controller
{
    /**
     * Dashboard page
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $balance = User::select([
            DB::raw('SUM(buyer_vnd) as total_buyer_vnd'),
            DB::raw('SUM(seller_vnd) as total_seller_vnd')
        ])->first();

        $account = Account::select([
            DB::raw('COUNT(CASE WHEN status = 1 THEN 1 END) as total_available'),
            DB::raw('COUNT(CASE WHEN status = 2 THEN 1 END) as total_sold')
        ])->first();

        $accountTransaction = AccountTransaction::select([
            DB::raw('SUM(price) as total_price'),
            DB::raw('SUM(seller_profit) as total_seller_profit'),
        ])->where('order_status', AccountTransaction::ORDER_SUCCESS)->where('order_status', )->first();

        $cardAmount = CardTransaction::where('status', CardTransaction::IS_SUCCESS_TRANSACTION)->sum('amount');
        $bankAmount = BankTransaction::where('type', BankTransaction::INCREASE_TYPE)->sum('amount');

        // Doanh thu bán nick hôm nay - card
        $todayRevenueCard = AccountTransaction::where('order_status', AccountTransaction::ORDER_SUCCESS)
            ->whereDate('created_at', Carbon::today())
            ->sum('price');

        // Doanh thu bán nick all - card
        $todayRevenueCardAll = $accountTransaction->total_price;

        // Tổng doanh thu vnd của CTV
        $totalPartnerRevenue = $accountTransaction->total_seller_profit;
        // Tổng doanh thu vnd: (TSR + ATM)
        $totalRevenue = $cardAmount + $bankAmount;
        // Tổng lợi nhuận vnd: (TSR + ATM) - CTV
        $totalProfit = $totalRevenue - $totalPartnerRevenue;

        // Số dư buyer
        $buyerVnd = $balance->total_buyer_vnd;
        // Số dư seller
        $sellerVnd = $balance->total_seller_vnd;
        
        // Tổng số nick còn lại
        $totalRemainingNicks = $account->total_available;
        // Tổng số nick đã bán
        $totalNumberOfNicksSold = $account->total_sold;

        $totalView = 0;

        return view('pages.admin.index', compact([
            'todayRevenueCard',
            'todayRevenueCardAll',
            'buyerVnd',
            'sellerVnd',
            'totalRemainingNicks',
            'totalNumberOfNicksSold',
            'totalPartnerRevenue',
            'totalRevenue',
            'totalProfit',
            'totalView',
        ])); 
    }
}
