<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CardTransaction;

class CardTransactionController extends Controller
{
    /**
     * List of card recharge
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $cards = CardTransaction::with(['user'])
            ->FilterBySerial($request->input('serial'))
            ->orderBy('id', 'DESC')
            ->paginate()
            ->withQueryString();

        return view('pages.admin.card.index', compact('cards'));
    }
}
