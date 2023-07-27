<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\CartRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $perPage = request('per_page', 10);
        $sortDirection = request('sort_direction', 'desc');
        $user_id = Auth::user()->id;
        try {
            $result = DB::table('cart_items')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->where('cart_items.state','!=', 9)
            ->where('cart_items.user_id','=', $user_id)
            ->orderBy('cart_items.id', $sortDirection)
            ->paginate($perPage);

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

    public function addProductToCart(CartRequest $request)
    {
        $data = $request->validated();
        $user_id = Auth::user()->id;

        try {
            DB::table('cart_items')->insert([
                'user_id' => $user_id,
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
            ]);
            return response()->json(['message' => 'Thêm vào giỏ hàng thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm vào giỏ hàng thất bại', 'error' => $e], 500);
        }
    }

    public function updateCart(CartRequest $request,$id)
    {
        $data = $request->validated();

        try {
            $cart = DB::table('cart_items')->where('id', $id)->first();

            if (isset($cart)) {
                DB::table('cart_items')->where('id', $id)->update([
                    'product_id' => $data['product_id'],
                    'quantity' => $data['quantity'],
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
            $cart = DB::table('cart_items')->where('id', $id)->first();

            if (isset($cart)) {
                $cart = $cart->update([
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
