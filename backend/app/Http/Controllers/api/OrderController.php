<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\OrderRequest;
use Auth;
class OrderController extends Controller
{
    public function index(Request $request)
    {

        $perPage = request('per_page', 10);
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        try {
            $result = DB::table('orders')
            ->where('state','!=', 9)
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy các hoá đơn thất bại',
            ], 500);
        }
    }

    public function getOrder($id)
    {
        try {
            $result = DB::table('orders')->where('id','=',$id)->first();

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy hoá đơn thất bại',
            ], 500);
        }
    }

    public function createOrder(Request $request)
    {
        $data = $request->validated();
        $user_id = Auth::user()->id;
        $cartItems = DB::table('cart_items')->where('user_id', $user_id)->get();

        try {
            DB::table('orders')->insert([
                'shipper_id' => $data['shipper_id'],
                'user_id' => $user_id,
                'shipping_method_id' => $data['shipping_method_id'],
                'order_status' => $data['order_status'],
                'shipping_cost' => $data['shipping_cost'],
                'total_amount' => $data['total_amount'],
                'note' => $data['note'],
                'order_date' => $data['order_date'],
                'shipped_date' => $data['shipped_date'],
                'required_date' => $data['required_date'],
            ]);
            return response()->json(['message' => 'Thêm mới hoá đơn thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới hoá đơn thất bại', 'error' => $e], 500);
        }
    }

    public function canceledOrder($id)
    {
        try {
            $order = DB::table('orders')->where('id', $id);

            if (isset($order)) {
                $order = $order->update([
                    'order_status' => 5,
                ]);
                return response()->json(['message' => 'Xoá hoá đơn thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy hoá đơn'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Xoá hoá đơn thất bại', 'error' => $e], 500);
        }
    }
}
