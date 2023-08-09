<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        try {
            $result = DB::table('categories')->where('name', 'like', "%{$search}%")
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
                'message' => 'Lấy các loại sản phẩm thất bại',
            ], 500);
        }
    }

    public function getCategory($id)
    {
        try {
            $result = DB::table('categories')->where('id',$id)->first();

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy danh mục thất bại',
            ], 500);
        }
    }

    public function createCategory(CategoryRequest $request)
    {
        $data = $request->validated();

        try {
            DB::table('categories')->insert([
                'name' => $data['name'],
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['message' => 'Thêm mới loại sản phẩm thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới loại sản phẩm thất bại', 'error' => $e], 500);
        }
    }

    public function updateCategory(CategoryRequest $request,$id)
    {
        $data = $request->validated();

        try {
            $category = DB::table('categories')->where('id', $id)->first();

            if (isset($category)) {
                DB::table('categories')->where('id', $id)->update([
                    'name' => $data['name'],
                    'updated_at' => Carbon::now(),
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
            $category = DB::table('categories')->where('id', $id);

            if (isset($category)) {
                $category = $category->delete();
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
