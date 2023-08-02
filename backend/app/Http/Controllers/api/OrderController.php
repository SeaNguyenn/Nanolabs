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
            ->where('is_active','!=', 9)
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
        $data = $request->validated();
        $user_id = Auth::user()->id;

        $cartItems = DB::table('cart_items')->where('user_id', $user_id)
            ->whereIn('product_id', $data['product_ids'])
            ->where('state', 1)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'No matching cart items found'], 400);
        }

        DB::beginTransaction();

        try {

            $totalAmount = 0;
            foreach ($cartItems as $cartItem) {
                $totalAmount += $cartItem->quantity * $cartItem->product->price;
            }

            $order = DB::table('orders')->create([
                'user_id' => $user_id,
                'shipper_id' => $data['shipper_id'],
                'shipping_method_id' => $data['shipping_method_id'],
                'total_amount' => $totalAmount,
                'order_status' => 1,
                'note' => $data['note'],
            ]);

            foreach ($cartItems as $cartItem) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                ]);

                $cartItem->update(['state' => 9]);
            }

            DB::commit();

            return response()->json(['message' => 'Thêm mới hoá đơn thành công'], 200);

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
                'order_status' => $data['order_status'],
                'shipper_id' => $data['shipper_id'],
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
            DB::table('orders')
            ->where('id', $id)
            ->update(['state' => 9]);

            return response()->json(['message' => 'Xoá hoá đơn thành công'], 200);
        } catch (\Exception $e) {

        }



    }
}
