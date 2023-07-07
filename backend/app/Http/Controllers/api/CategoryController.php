<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\ProductRequest;
class CategoryController extends Controller
{
    public function getAllCategorys(Request $request)
    {
        $data =DB::table('categories');

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
                'message' => 'Lấy các loại sản phẩm thất bại',
            ], 500);
        }
    }

    public function getCategory($id)
    {
        $data =DB::table('categories');

        $category = $data->where('id',$id);

        try {
            $result = $category->get();

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy loại sản phẩm thất bại',
            ], 500);
        }
    }

    public function createCategory(CategoryRequest $request)
    {
        $request->only([
            'Category_name' ,
            'Category_code' ,
            'description' ,
            'image' ,
            'price',
            'color' ,
            'material' ,
            'quantity',
            'warranty',
        ]);

        try {
            DB::table('categories')->insert([
                'Category_name' => $request->Category_name,
                'Category_code' => $request->Category_code,
                'description' => $request->description,
                'image' => $request->image,
                'price' => $request->price,
                'color' => $request->color,
                'material' => $request->material,
                'quantity' => $request->quantity,
                'warranty' => $request->warranty
            ]);
            return response()->json(['message' => 'Thêm mới loại sản phẩm thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới loại sản phẩm thất bại', 'error' => $e], 500);
        }
    }

    public function updateCategory(CategoryRequest $request,$id)
    {
        $request->only([
            'Category_name' ,
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
            $category =DB::table('categories')->where('id', $id)->first();

            if (isset($category)) {
                DB::table('categories')->where('id', $id)->update([
                    'Category_name' => $request->Category_name,
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
                return response()->json(['message' => 'Cập nhật loại sản phẩm thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy loại sản phẩm'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Cập nhật loại sản phẩm thất bại', 'error' => $e], 500);
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category =DB::table('categories')->where('id', $id)->first();

            if (isset($category)) {
                DB::table('categories')->where('id', $id)->update([
                    'state' => 9,
                ]);
                return response()->json(['message' => 'Xoá loại sản phẩm thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy loại sản phẩm'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Xoá loại sản phẩm thất bại', 'error' => $e], 500);
        }
    }
}
