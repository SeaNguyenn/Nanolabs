<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\ProductRequest;
class SupplierController extends Controller
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
                'message' => 'Lấy các giỏ hàng thất bại',
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
                'message' => 'Lấy giỏ hàng thất bại',
            ], 500);
        }
    }

    public function createOrder(OrderRequest $request)
    {
        $request->only([
            'order_name' ,
            'order_code' ,
            'description' ,
            'image' ,
            'price',
            'color' ,
            'material' ,
            'quantity',
            'warranty',
        ]);

        try {
            DB::table('orders')->insert([
                'order_name' => $request->order_name,
                'order_code' => $request->order_code,
                'description' => $request->description,
                'image' => $request->image,
                'price' => $request->price,
                'color' => $request->color,
                'material' => $request->material,
                'quantity' => $request->quantity,
                'warranty' => $request->warranty
            ]);
            return response()->json(['message' => 'Thêm mới giỏ hàng thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới giỏ hàng thất bại', 'error' => $e], 500);
        }
    }

    public function updateOrder(OrderRequest $request,$id)
    {
        $request->only([
            'order_name' ,
            'description' ,
            'image' ,
            'price',
            'promotion_price',
            'include_vat',
            'evaluate',
            'color',
            'material' ,
            'quantity',
            'warranty',
        ]);

        try {
            $order = DB::table('orders')->where('id', $id)->first();

            if (isset($order)) {
                DB::table('orders')->where('id', $id)->update([
                    'order_name' => $request->order_name,
                    'description' => $request->description,
                    'image' => $request->image,
                    'price' => $request->price,
                    'promotion_price' => $request->promotion_price,
                    'include_vat' => $request->include_vat,
                    'evaluate' => $request->evaluate,
                    'color' => $request->color,
                    'material' => $request->material,
                    'quantity' => $request->quantity,
                    'warranty' => $request->warranty
                ]);
                return response()->json(['message' => 'Cập nhật giỏ hàng thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy giỏ hàng'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Cập nhật giỏ hàng thất bại', 'error' => $e], 500);
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
                return response()->json(['message' => 'Xoá giỏ hàng thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy giỏ hàng'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Xoá giỏ hàng thất bại', 'error' => $e], 500);
        }
    }
}
