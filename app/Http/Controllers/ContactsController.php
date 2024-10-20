<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contacts\CallbackRequest;
use App\Models\Configuration;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    public function send(CallbackRequest $request): JsonResponse
    {
        try {
            Mail::html(view('emails.callback', $request->input())->render(), function ($message) {
                $message
                    ->to(Configuration::get()->first()->callback_email)
                    ->subject('Запрос обратного звонка');
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json([
            'status' => 'ok',
        ]);
    }
}
