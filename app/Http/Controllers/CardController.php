<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PostCardRequest;
use App\Models\CardTransaction;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Hiển thị màn hình nạp card
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('pages.deposit');
        $domain = config('thesieure.domain');
        $partnerId = config('thesieure.partner_id');
        $jsonCardOptions = Http::get("{$domain}/chargingws/v2/getfee?partner_id={$partnerId}");
        $cardOptions = json_decode($jsonCardOptions);
        $cardTypes = CardTransaction::CARD_TYPES;
        $cardValues = [];

        if (!empty( $cardOptions)) {
            foreach ($cardOptions as $cardOption) {
                if (in_array($cardOption->telco, array_keys($cardTypes))) {
                    if (empty($cardValues[$cardOption->telco])) {
                        $cardValues[$cardOption->telco] = [];
                    }
                    $cardValues[$cardOption->telco][] = $cardOption->value;
                }
            }
        }

        $historyCards = collect();

        if (Auth::check()) {
            $historyCards = CardTransaction::select('id', 'status', 'telco', 'code', 'declared_value', 'value', 'created_at', 'serial')
                ->where('user_id', Auth::id())
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('pages.card', compact([
            'cardTypes', 
            'cardValues',
            'historyCards',
        ]));
    }

    /**
     *  Người dùng thực hiện nạp thẻ
     * 
     * @param \App\Http\Requests\PostCardRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCard(PostCardRequest $request)
    {
        $userId =  Auth::id();
        $domain = config('thesieure.domain');
        $partnerId = config('thesieure.partner_id');
        $partnerKey = config('thesieure.partner_key');
        
        if (empty($partnerId) || empty($partnerKey)) {
            return back()->withErrors([
                'error' => 'Chức năng hiện đang bảo trì, vui lòng thử lại sau!',
            ]);
        }

        $reuqestId = $userId . '_' . Carbon::now()->timestamp;
        $sign = md5($partnerKey . $request->code . $request->serial);

        $response = Http::accept('application/json')->post("{$domain}/chargingws/v2", [
            'telco' => $request->telco,
            'code' => $request->code,
            'serial' => $request->serial,
            'amount' => $request->declared_value,
            'request_id' => $reuqestId,
            'partner_id' => $partnerId,
            'sign' => $sign,
            'command' => 'charging',
        ]);

        if ($response->status() != 200) {
            Log::channel('CardTransaction')->error(json_encode([
                'method' => 'postCard',
                'user_id' => $userId,
                'response' => $response->body(),
            ]));

            return redirect()->back()->withErrors(['errors' => __('common.server_error')]);
        }

        $responseData = $response->json();

        $dataInsert = [
            'callback_sign' => $sign ,
            'request_id' => $reuqestId,
            'telco' => $request->telco,
            'serial' => $request->serial,
            'code' => $request->code,
            'trans_id' => $responseData['trans_id'],
            'value' => $responseData['value'],
            'message' => $responseData['message'],
            'declared_value' => $request->declared_value,
            'amount' => $responseData['amount'],
            'response_code' => $responseData['status'],
            'user_id' => $userId,
            'log' => json_encode($responseData),
        ];

        if (in_array($responseData['status'], haystack: [CardTransaction::IS_SUCCESSFUL_CARD, CardTransaction::IS_SUCCESSFUL_CARD_WRONG_DENOMINATION])) {
            $dataInsert['status'] = CardTransaction::IS_SUCCESS_TRANSACTION;
            CardTransaction::insert($dataInsert);
            return redirect()->back()->with('success', __('thesieure.' . $responseData['status']));
        }

        if (in_array($responseData['status'], [CardTransaction::IS_PENDING_CARD])) {
            $dataInsert['status'] = CardTransaction::IS_PROCESSING_TRANSACTION;
            CardTransaction::insert($dataInsert);
            return redirect()->back()->with('success', __('thesieure.' . $responseData['status']));
        }

        if ($responseData['status'] < 100) {
            $dataInsert['status'] = CardTransaction::IS_ERROR_TRANSACTION;
            CardTransaction::insert($dataInsert);
            return redirect()->back()->withErrors(['errors' => __('thesieure.' . $responseData['status'])]);
        }

        Log::channel('CardTransaction')->error(json_encode([
            'user_id' => $userId,
            'response' => $responseData,
        ]));

        return redirect()->back()->withErrors(['errors' => __('common.client_error')]);
    }

    /**
     * Xử lí callbackCard
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function callbackCard(Request $request)
    {
        if (!$request->has('status') || !$request->has('request_id') || !$request->has('callback_sign')) {
            Log::channel('CardTransaction')->error(json_encode([
                'method' => 'callbackCard',
                'message' => 'Giao dịch thiếu các trường cần thiết',
                'request' => $request->input(),
            ]));
            return response()->json([
                'status' => 'fail',
                'message' => 'Giao dịch thiếu các trường cần thiết',
            ]);
        }

        $cardTran = CardTransaction::select('id', 'user_id', 'log')
                ->where('request_id', $request->request_id)
                ->where('callback_sign', $request->callback_sign)->first();

        if (empty($cardTran)) {
            Log::channel('CardTransaction')->error(json_encode([
                'method' => 'callbackCard',
                'message' => 'Không tìm thấy giao dịch trong database',
                'request' => $request->input(),
            ]));
            return response()->json([
                'status' => 'fail',
                'message' => 'Không tìm thấy giao dịch trong database',
            ]);
        }

        $status = CardTransaction::IS_SUCCESS_TRANSACTION;
        if ($request->status != CardTransaction::IS_SUCCESS_TRANSACTION) {
            $status = CardTransaction::IS_ERROR_TRANSACTION;
        }

        $dataUpdate = [
            'status' => $status,
            'response_code' => $request->status,
            'message' => $request->message,
            'trans_id' => $request->trans_id,
            'value' => $request->value,
            'amount' => $request->amount,
            'log' => $cardTran->log . "\n" . json_encode($request->input()),
        ];

        try {
            DB::beginTransaction();
            CardTransaction::where('id', $cardTran->id)->update($dataUpdate);

            if (!empty($request->value) && is_numeric($request->value)) {
                $user = User::where('id', $cardTran->user_id)->first();

                if (!empty($user)) {
                    $user->buyer_vnd += $request->value;
                    $user->save();
                } else {
                    Log::channel('CardTransaction')->error(json_encode([
                        'method' => 'callbackCard',
                        'message' => "Không tìm thấy user có id {$cardTran->user_id} để cập nhật tiền",
                    ]));
                }
            } else {
                Log::channel('CardTransaction')->error(json_encode([
                    'method' => 'callbackCard',
                    'message' => "Value trả về không hợp lệ: {$request->value}",
                ]));
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('CardTransaction')->error(json_encode([
                'method' => 'callbackCard',
                'message' => $e->getMessage(),
            ]));
            return response()->json([
                'status' => 'fail',
            ]);
        }
        
        return response()->json([
            'status' => 'success',
        ]);
    }
}
