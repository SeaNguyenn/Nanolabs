<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\ProductRequest;

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
            $result = $data->paginate(10);

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

    public function createProduct(ProductRequest $request)
    {
        $request->only([
            'name' ,
            'code' ,
            'description' ,
            'image' ,
            'price',
            'color' ,
            'material' ,
            'quantity',
            'warranty',
        ]);

        try {

            $products = DB::table('products');

            $products->insert([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'image' => $request->image,
                'price' => $request->price,
                'color' => $request->color,
                'material' => $request->material,
                'quantity' => $request->quantity,
                'warranty' => $request->warranty,
                'create_user' => Auth::user()->name,
                'supplier_id' => $request->supplier_id,
                'category_id' => $request->category_id,
            ]);
            return response()->json(['message' => 'Thêm mới sản phẩm thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới sản phẩm thất bại', 'error' => $e], 500);
        }
    }

    public function updateProduct(ProductRequest $request,$id)
    {
        $request->only([
            'name',
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
            $product = DB::table('products')->where('id', $id)->first();

            if (isset($product)) {
                DB::table('products')->where('id', $id)->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $request->image,
                    'price' => $request->price,
                    'promotion_price' => $request->promotion_price,
                    'include_vat' => $request->include_vat,
                    'evaluate' => $request->evaluate,
                    'color' => $request->color,
                    'material' => $request->material,
                    'quantity' => $request->quantity,
                    'warranty' => $request->warranty,
                    'update_user' => Auth::user()->name,
                    'supplier_id' => $request->supplier_id,
                    'category_id' => $request->category_id,
                ]);
                return response()->json(['message' => 'Cập nhật sản phẩm thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy sản phẩm'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Cập nhật sản phẩm thất bại', 'error' => $e], 500);
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = DB::table('products')->where('id', $id)->first();

            if (isset($product)) {
                DB::table('products')->where('id', $id)->update([
                    'state' => 9,
                ]);
                return response()->json(['message' => 'Xoá sản phẩm thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy sản phẩm'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Xoá sản phẩm thất bại', 'error' => $e], 500);
        }
    }
}
