<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\ShipperRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ShipperController extends Controller
{
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        try {
            $result = DB::table('shippers')->where('name', 'like', "%{$search}%")
            ->where('is_active',1)
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
                'message' => 'Lấy các nhân viên shipper thất bại',
            ], 500);
        }
    }

    public function getShipper($id)
    {
        try {
            $result = DB::table('shippers')->where('id',$id)->first();

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy nhân viên shipper thất bại',
            ], 500);
        }
    }

    public function createShipper(ShipperRequest $request)
    {
        $data = $request->validated();

        $image = $data['image'] ?? null;

        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
        }

        try {
            DB::table('shippers')->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'image' => $data['image'],
                'address' => $data['address'],
                'created_at' => Carbon::now(),
                'is_active' => 1,
            ]);
            return response()->json(['message' => 'Thêm mới nhân viên shipper thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới nhân viên shipper thất bại', 'error' => $e], 500);
        }
    }

    public function updateShipper(ShipperRequest $request,$id)
    {
        $data = $request->validated();
        $shipper = DB::table('shippers')->where('id', $id)->first();
        $image = $data['image'] ?? null;

        if ($image) {
            if ($shipper->image) {
                Storage::deleteDirectory('/public' . dirname($shipper->image));
            }
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
        }

        try {
            $shipper = DB::table('shippers')->where('id', $id)->first();

            if (isset($shipper)) {
                DB::table('shippers')->where('id', $id)->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'image' => $data['image'],
                    'address' => $data['address'],
                    'updated_at' => Carbon::now(),
                ]);
                return response()->json(['message' => 'Cập nhật nhân viên shipper thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy nhân viên shipper'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Cập nhật nhân viên shipper thất bại', 'error' => $e], 500);
        }
    }

    public function deleteShipper($id)
    {
        try {
            $shipper = DB::table('shippers')->where('id', $id);

            if (isset($shipper)) {
                $shipper = $shipper->update([
                    'is_active' => 9,
                ]);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy nhân viên shipper'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Xoá nhân viên shipper thất bại', 'error' => $e], 500);
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
