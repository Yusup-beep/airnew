<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search\SubmitSearchRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\Category;


class SearchController extends Controller
{
    public function index(SubmitSearchRequest $request): View
    {
        $keyword = $request->get('query');

        $items = Category::with('products')
            ->has('products')
            ->where(function ($query) use ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('info', 'like', '%' . $keyword . '%')
                    ->orWhere('keywords', 'like', '%' . $keyword . '%')
                    ->orWhere('announcement', 'like', '%' . $keyword . '%');
            })
            ->orWhereHas('products', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->get();

        return view('pages.search', [
            'keyword' => $keyword,
            'items' => $items,
        ]);
    }
}
