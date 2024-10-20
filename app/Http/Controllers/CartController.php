<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Classes\SimpleXLSXGen;
use App\Classes\SimpleXLSX;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService,
    )
    {
    }

    public function get(): JsonResponse
    {
        $cart = $this->cartService->get();
        return response()->json([
            'quantity' => $cart->count(),
            'items' => $cart->values()->toArray(),
        ]);
    }

    public function add(AddToCartRequest $request): JsonResponse
    {
        $cart = $this->cartService->set(
            $request->input('product_id'),
            $request->input('quantity'),
        );

        return response()->json([
            'quantity' => $cart->count(),
            'items' => $cart->values()->toArray(),
        ]);
    }

    public function upload(Request $request): RedirectResponse
    {   
        $file = $request->cart->path();

        $xlsx = SimpleXLSX::parse($file);

        $rows = $xlsx->rows();

        $cart = $this->cartService->get()->toArray();

        $result = [];

        foreach ($rows as $key => $value) {
            if ($key !== 0) {
                $id = $value[0];
                $amount = $value[2];

                array_push($result, [
                    'product_id' => $id,
                    'amount' => $amount
                ]);
            }
        }

        foreach (array_merge($result, $cart) as $key => $value) {
            if (!empty($cart) && isset($cart[$key]) && $cart[$key]['product_id'] === $value['product_id']) {
                $result[$key]['amount'] = intval($value['amount']) + intval($cart[$key]['amount']);
            }

            if (!empty($cart) && isset($cart[$key]) && $cart[$key]['product_id'] !== $value['product_id']) {
                array_push($result, $cart[$key]);
            }
        }

        session()->put('cart', $result);

        return Redirect::to('cart');
    }

    public function download(Request $request): RedirectResponse
    {   
        $cart = $this->cartService->get();
        
        if ($cart->count()) {
            $columns = [
                ['ID', 'Название', 'Количество']
            ];

            foreach ($cart as $key => $item) {
                $product = Product::find($item['product_id']);
    
                $columns[$key + 1] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'amount' => $item['amount']
                ];
            }
    
            $xlsx = SimpleXLSXGen::fromArray($columns);
    
            $xlsx->downloadAs('cart.xlsx');
        }

        return Redirect::back();
    }
}
