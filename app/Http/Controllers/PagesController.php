<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\SubmitCartRequest;
use App\Models\Configuration;
use App\Models\Product;
use App\Models\Orders;
use App\Services\CartService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;

class PagesController extends Controller
{
    public function __construct(
        private readonly CartService $cartService,
    ) {}

    public function index()
    {
        $agent = new Agent();
        $slider = $agent->isMobile() ? Configuration::get()->first()->main_mobile_slider : Configuration::get()->first()->main_slider;
        return view('pages.index', ['slider' => $slider]);
    }

    public function project()
    {
        return view('pages.project');
    }

    public function montazh()
    {
        return view('pages.montazh');
    }

    public function rent()
    {
        return view('pages.rent');
    }

    public function service()
    {
        return view('pages.service');
    }

    public function cart(Request $request)
    {
        $items = $this->cartService->get();
        $products = Product::query()
            ->whereIn('id', $items->pluck('product_id'))
            ->get();
        return view('cart.index', [
            'success' => $request->get('success', false),
            'message' => $request->get('message', false),
            'items' => $items->map(function (array $item) use ($products) {
                return [
                    ...$item,
                    'product' => $products->where('id', $item['product_id'])->first(),
                ];
            }),
        ]);
    }

    public function submitCart(SubmitCartRequest $request)
    {
        $success = true;
        $items = $this->cartService->get();
        $products = Product::query()
            ->whereIn('id', $items->pluck('product_id'))
            ->get();

        $html = view('emails.new-order', [
            ...$request->input(),
            'items' => $items->map(function (array $item) use ($products) {
                return [
                    ...$item,
                    'product' => $products->where('id', $item['product_id'])->first(),
                ];
            }),
        ])->render();
        $request->merge(['items' => $items]);
        Orders::create($request->all());
        Mail::html($html, function ($message) {
            $message
                ->to(Configuration::get()->first()->callback_email)
                ->subject('Запрос обратного звонка');
        });
        $this->cartService->save(collect());
        return view('cart.modal_success');
    }
}
