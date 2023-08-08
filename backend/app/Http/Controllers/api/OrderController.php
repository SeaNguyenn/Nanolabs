<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\OrderRequest;
use Auth;
use Carbon\Carbon;
class OrderController extends Controller
{
    public function index(Request $request)
    {

        $perPage = request('per_page', 10);
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        try {
            $result = DB::table('orders')
            ->where('is_active', true)
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
            $order = DB::table('orders')
            ->select('orders.*', 'order_details.*')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.id', $id)
            ->get();

            if ($order->isEmpty()) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $order,
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
        $data = $request->all();
        $user_id = Auth::user()->id;

        $cartItems = DB::table('cart_items')->where('user_id', $user_id)
            ->whereIn('product_id', $data['product_ids'])
            ->where('is_active', true)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Giỏ hàng của bạn đang trống'], 400);
        }

        DB::beginTransaction();

        try {

            $order_id = DB::table('orders')->insertGetId([
                'user_id' => $user_id,
                'total_amount' => $data['total_amount'],
                'order_status' => 1,
                'is_active' => true,
            ]);

            foreach ($cartItems as $cartItem) {
                DB::table('order_details')->insert([
                    'order_id' => $order_id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'is_active' => true,
                    'created_at' => Carbon::now(),
                ]);

                DB::table('cart_items')->where('id', $cartItem->id)->update(['is_active' => false]);
            }

            DB::commit();

            return response()->json([
                'order_id' => $order_id,
                'message' => 'Thêm mới hoá đơn thành công'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới hoá đơn thất bại', 'error' => $e], 500);
        }
    }

    public function updateOrderStatusAndShipper(Request $request, $id)
    {
        $data = $request->validate();

        $result = DB::table('orders')
            ->where('id', $id)
            ->update([
                'shipper_id' => $data['shipper_id'],
                'order_status' => $data['order_status'],
                'shipper_method_id' => $data['shipper_method_id'],
                'order_date' => $data['order_date'],
                'shipper_date' => $data['shipper_date'],
                'required_date' => $data['required_date'],
                'updated_at' => now(),
            ]);

        if ($result === 0) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json(['message' => 'Order status and shipper updated successfully'], 200);
    }


    public function canceledOrder($id)
    {
        try {
            $order = DB::table('orders')->where('id', $id);

            if (isset($order)) {
                $order = $order->update([
                    'order_status' => 5,
                    'updated_at' => now(),
                ]);
                return response()->json(['message' => 'từ chối hoá đơn thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy hoá đơn'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'từ chối hoá đơn thất bại', 'error' => $e], 500);
        }
    }

    public function deleteOrder($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        try {
            DB::table('orders')->where('id', $id)->update(['is_active' => false]);

            return response()->json(['message' => 'Xoá hoá đơn thành công'], 200);
        } catch (\Exception $e) {

        }
    }
}
