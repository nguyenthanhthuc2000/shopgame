<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Summary of index
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return mixed|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, Category $category)
    {
        if ($category->status !== Category::ACTIVE_STATUS) {
            flash()->error('Danh mục game không còn hoạt động!');
            return redirect()->route('home');
        }

        $selected = $request->all();
        $classes = Account::CLASSES;
        $regisTypes = Account::REGIS_TYPE;
        $earring = Account::EARRING;
        $servers = Account::SERVER;
        $prices = config('account.pirce_options');
        $status = collect(Account::STATUS)->where('value', '!==', 0);

        $accounts = Account::select('server', 'earring', 'price', 'class', 'regis_type', 'id', 'uuid')
            ->with(['banner'])
            ->where('category_id', $category->id)
            ->ByServer($request->input('server_game', null))
            ->ByCode($request->input('code', null))
            ->ByStatus($request->input('status', Account::STATUS_AVAILABLE))
            ->ByPrice($request->input('price', null))
            ->ByClass($request->input('class', null))
            ->orderBy('id', 'DESC')
            ->paginate()
            ->withQueryString();

        return view('pages.account.accounts', compact([
            'category',
            'accounts',
            'classes',
            'regisTypes',
            'earring',
            'servers',
            'prices',
            'status',
            'selected'
        ]));
    }

    /**
     * Summary of list
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list(Request $request)
    {
        $categories = Category::withCount([
            'soldAccounts as sold_count',
            'unsoldAccounts as unsold_count',
        ])->orderBy('id', 'DESC')->get();

        return view('pages.categories', compact('categories'));
    }
}
