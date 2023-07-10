<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\ShoppingCartRequest;
class ShoppingCartController extends Controller
{
    public function getAllCart(Request $request)
    {
        $data = DB::table('shopping_cart');

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

    public function getCart($id)
    {
        $data = DB::table('shopping_cart');

        $cart = $data->where('id',$id);

        try {
            $result = $cart->leftJoin('products', $cart['product_id'], '=', 'products.id')->get();

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

    public function createCart(ShoppingCartRequest $request)
    {
        $request->only([
            'product_name' ,
        ]);

        try {

            $products = DB::table('shopping_cart');

            $products->insert([
                'product_id' => $request->product_id,
            ]);
            return response()->json(['message' => 'Thêm vào giỏ hàng thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm vào giỏ hàng thất bại', 'error' => $e], 500);
        }
    }

    public function updateOrder(ShoppingCartRequest $request,$id)
    {
        try {
            $cart = DB::table('shopping_cart')->where('id', $id)->first();

            if (isset($cart)) {
                DB::table('shopping_cart')->where('id', $id)->update([
                    'product_id' => $request->product_id,
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

    public function deleteCart($id)
    {
        try {
            $cart = DB::table('shopping_cart')->where('id', $id)->first();

            if (isset($cart)) {
                DB::table('shopping_cart')->where('id', $id)->update([
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
