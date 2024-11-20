<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\CardTransaction;

class CardTransactionController extends Controller
{
    /**
     * Danh sách nạp thẻ cào
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $cardTrans = CardTransaction::with(['user'])->orderBy('id', 'DESC')->paginate();

        return view('pages.admin.card.index', compact('cardTrans'));
    }
}
