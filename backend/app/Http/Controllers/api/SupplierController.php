<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\SupplierRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SupplierController extends Controller
{
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        try {
            $result = DB::table('suppliers')->where('brand_name', 'like', "%{$search}%")
            ->where('state','!=', 9)
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
                'message' => 'Lấy các nhà cung cấp thất bại',
            ], 500);
        }
    }

    public function getSupplier($id)
    {
        try {
            $result = DB::table('suppliers')->where('id','=',$id)->first();

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy danh sách nhà cung cấp thất bại',
            ], 500);
        }
    }

    public function createSupplier(SupplierRequest $request)
    {
        $data = $request->validated();
        $image = $data['avatar'] ?? null;

        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['avatar'] = URL::to(Storage::url($relativePath));
        }

        try {
            DB::table('suppliers')->insert([
                'brand_name' => $data['brand_name'],
                'avatar' => $data['avatar'],
                'email' => $data['email'],
                'evaluate' => $data['evaluate'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'state' => 1,
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['message' => 'Thêm mới nhà cung cấp thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới nhà cung cấp thất bại', 'error' => $e], 500);
        }
    }

    public function updateSupplier(Request $request,$id)
    {
        $data = $request->all();
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        $image = $data['avatar'] ?? null;

        if ($image) {
            if ($supplier->avatar) {
                Storage::deleteDirectory('/public' . dirname($supplier->avatar));
            }
            $relativePath = $this->saveImage($image);
            $data['avatar'] = URL::to(Storage::url($relativePath));
        }

        try {
            $supplier =DB::table('suppliers')->where('id', $id)->first();

            if (isset($supplier)) {
                DB::table('suppliers')->where('id', $id)->update([
                    'brand_name' => $data['brand_name'],
                    'avatar' => $data['avatar'],
                    'email' => $data['email'],
                    'evaluate' => $data['evaluate'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'state' => 1,
                    'updated_at' => Carbon::now(),
                ]);
                return response()->json(['message' => 'Cập nhật nhà cung cấp thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy nhà cung cấp'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Cập nhật nhà cung cấp thất bại', 'error' => $e], 500);
        }
    }

    public function deleteSupplier($id)
    {
        try {
            $supplier = DB::table('suppliers')->where('id', $id);

            if (isset($supplier)) {
                $supplier = $supplier->update([
                    'state' => 9,
                ]);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy danh sách nhà cung cấp'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Xoá danh sách nhà cung cấp thất bại', 'error' => $e], 500);
        }
    }

    private function saveImage(UploadedFile $image)
    {
        $path = 'images/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }

        return $path . '/' . $image->getClientOriginalName();
    }
}
