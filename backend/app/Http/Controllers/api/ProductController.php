<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;
class ProductController extends Controller
{
    public function getAllProducts(Request $request)
    {
        $data = DB::table('products');

        if (isset($request->keyword)) {
            $keyword = $request->input('keyword');

            $data = $data->where('name', 'like', '%'.$keyword.'%');
        }

        try {
            $result = $data->get();

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy các sản phẩm thất bại',
            ], 500);
        }
    }

    public function getProduct($id)
    {
        $data = DB::table('products');

        $product = $data->where('id',$id);

        try {
            $result = $product->get();

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy sản phẩm thất bại',
            ], 500);
        }
    }


}
