<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\SupplierRequest;
class SupplierController extends Controller
{
    public function getAllSuppliers(Request $request)
    {
        $data = DB::table('suppliers');

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

    public function getSupplier($id)
    {
        $data =DB::table('suppliers');

        $Supplier = $data->where('id',$id);

        try {
            $result = $Supplier->get();

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

    public function createSupplier(SupplierRequest $request)
    {
        $request->only([
            'name' ,
            'parent_id' ,
            'display_order',
        ]);

        try {
            DB::table('suppliers')->insert([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'display_order' => $request->display_order,
                'state' => 1,
            ]);
            return response()->json(['message' => 'Thêm mới loại sản phẩm thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới loại sản phẩm thất bại', 'error' => $e], 500);
        }
    }

    public function updateSupplier(SupplierRequest $request,$id)
    {
        $request->only([
            'name' ,
            'parent_id' ,
            'display_order',
        ]);

        try {
            $Supplier =DB::table('suppliers')->where('id', $id)->first();

            if (isset($Supplier)) {
                DB::table('suppliers')->where('id', $id)->update([
                    'name' => $request->name,
                    'parent_id' => $request->parent_id,
                    'display_order' => $request->display_order,
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

    public function deleteSupplier($id)
    {
        try {
            $Supplier = DB::table('suppliers')->where('id', $id)->first();

            if (isset($Supplier)) {
                $Supplier = $Supplier->update([
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
