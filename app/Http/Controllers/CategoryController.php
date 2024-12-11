<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Account;

class CategoryController extends Controller
{
    /**
     * Trang danh mục game
     *
     * @param Request $request
     */
    public function index(Request $request, $slug)
    {
        $category = Category::IsActive()->whereSlug($slug)->first();

        if (empty($category) || !empty($category) && $category->status == 0) {
            return redirect()->route('home');
        }

        $accounts = Account::select('server', 'earring', 'price', 'class', 'regis_type', 'uuid')
            ->with(['banner'])
            ->where('category_id', $category->id)
            ->where('status', Account::STATUS_AVAILABLE)
            ->orderBy('id', 'DESC');

        $classes = Account::CLASSES;
        $regisTypes = Account::REGIS_TYPE;
        $earring = Account::EARRING;
        $servers = Account::SERVER;
        $prices = config('account.pirce_options');
        $status = collect(Account::STATUS)->where('value', '!==', 0);

        $accounts = Account::select('server', 'earring', 'price', 'class', 'regis_type', 'id', 'uuid')
            ->with(['banner'])
            ->where('category_id', $category->id)
            ->where('status', Account::STATUS_AVAILABLE);

        if ($request->code) {
            $accounts = $accounts->byCode($request->code);
        }

        if ($request->price) {
            $accounts = $accounts->byPrice($request->price);
        }

        if ($request->server_game) {
            $accounts = $accounts->byServer($request->server_game);
        }

        if ($request->class) {
            $accounts = $accounts->byClass($request->class);
        }

        $accounts = $accounts->orderBy('id', 'DESC')
            ->paginate()
            ->withQueryString();

        return view('pages.accounts', compact([
            'category',
            'accounts',
            'classes',
            'regisTypes',
            'earring',
            'servers',
            'prices',
            'status',
        ]));
    }
    public function show($slug)
    {
        $category = Category::whereSlug($slug)->first()->accounts;
        $accounts = $category->accounts;

        return view('pages.product', compact('accounts', 'category'));
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