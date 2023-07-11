<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\OrderRequest;
class OrderController extends Controller
{
    public function getAllOrders(Request $request)
    {
        $data = DB::table('orders');

        if (isset($request->keyword)) {
            $keyword = $request->input('keyword');

            $data = $data->where('name', 'like', '%'.$keyword.'%');
        }

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
                'message' => 'Lấy các hoá đơn thất bại',
            ], 500);
        }
    }

    public function getOrder($id)
    {
        $data = DB::table('orders');

        $order = $data->where('id',$id);

        try {
            $result = $order->get();

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

    public function createOrder(OrderRequest $request)
    {
        try {
            DB::table('orders')->insert([
                'shipper_id' => $request->shipper_id,
                'user_id' => $request->user_id,
                'order_status_id' => $request->order_status_id,
                'shipping_cost' => $request->shipping_cost,
                'total_amount' => $request->total_amount,
                'note' => $request->note,
                'order_date' => $request->order_date,
                'shipped_date' => $request->shipped_date,
                'required_date' => $request->required_date,
            ]);
            return response()->json(['message' => 'Thêm mới hoá đơn thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới hoá đơn thất bại', 'error' => $e], 500);
        }
    }

    public function updateOrder(OrderRequest $request,$id)
    {
        try {
            $order = DB::table('orders')->where('id', $id)->first();

            if (isset($order)) {
                DB::table('orders')->where('id', $id)->update([
                    'shipper_id' => $request->shipper_id,
                    'user_id' => $request->user_id,
                    'order_status_id' => $request->order_status_id,
                    'shipping_cost' => $request->shipping_cost,
                    'total_amount' => $request->total_amount,
                    'note' => $request->note,
                    'order_date' => $request->order_date,
                    'shipped_date' => $request->shipped_date,
                    'required_date' => $request->required_date,
                ]);
                return response()->json(['message' => 'Cập nhật hoá đơn thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy hoá đơn'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Cập nhật hoá đơn thất bại', 'error' => $e], 500);
        }
    }

    public function deleteOrder($id)
    {
        try {
            $order = DB::table('orders')->where('id', $id)->first();

            if (isset($order)) {
                DB::table('orders')->where('id', $id)->update([
                    'state' => 9,
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
