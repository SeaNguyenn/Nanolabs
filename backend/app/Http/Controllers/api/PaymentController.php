<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function getAllPayment(Request $request)
    {
        $data = DB::table('payments');

        try {
            $result = $data->paginate(10);

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy các thanh toán thất bại',
            ], 500);
        }
    }

    public function getPayment($id)
    {
        $data = DB::table('payments');

        $payment = $data->where('id',$id);

        try {
            $result = $payment
            ->leftJoin('payment_method', $payment['payment_method_id'], '=', 'payment_method.id')
            ->leftJoin('payment_status', $payment['payment_status_id'], '=', 'payment_status.id')
            ->get();

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy thanh toán thất bại',
            ], 500);
        }
    }

    public function createPayment(PaymentRequest $request)
    {
        $request->only([
            'payment_date',
            'payment_amount',
            'note',
            'transaction_id',
        ]);

        try {
            $products = DB::table('payments');

            $products->insert([
                'order_id' => $request->order_id,
                'payment_method_id' => $request->payment_method_id,
                'payment_status_id' => $request->payment_status_id,
                'payment_date' => $request->payment_date,
                'payment_amount' => $request->payment_amount,
                'note' => $request->note,
                'transaction_id' => $request->transaction_id,
            ]);
            return response()->json(['message' => 'Thêm vào thanh toán thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm vào thanh toán thất bại', 'error' => $e], 500);
        }
    }

    public function updateOrder(PaymentRequest $request,$id)
    {
        $request->only([
            'payment_date',
            'payment_amount',
            'note',
            'transaction_id',
        ]);

        try {
            $payment = DB::table('payments')->where('id', $id)->first();

            if (isset($payment)) {
                DB::table('payments')->where('id', $id)->update([
                    'order_id' => $request->order_id,
                    'payment_method_id' => $request->payment_method_id,
                    'payment_status_id' => $request->payment_status_id,
                    'payment_date' => $request->payment_date,
                    'payment_amount' => $request->payment_amount,
                    'note' => $request->note,
                    'transaction_id' => $request->transaction_id,
                ]);
                return response()->json(['message' => 'Cập nhật thanh toán thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy thanh toán'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Cập nhật thanh toán thất bại', 'error' => $e], 500);
        }
    }

    public function deleteCart($id)
    {
        try {
            $payment = DB::table('payments')->where('id', $id)->first();

            if (isset($payment)) {
                $payment = $payment->update([
                    'state' => 9,
                ]);
                return response()->json(['message' => 'Xoá thanh toán thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy thanh toán'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Xoá thanh toán thất bại', 'error' => $e], 500);
        }
    }
}
