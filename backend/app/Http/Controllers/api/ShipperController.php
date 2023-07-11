<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\ShipperRequest;
class ShipperController extends Controller
{
    public function getAllShippers(Request $request)
    {
        $data = DB::table('shippers')
                ->leftJoin('shipping_method', 'shipper.shipping_method_id', '=', 'shipping_method.id');

        if (isset($request->keyword)) {
            $keyword = $request->input('keyword');

            $data = $data->where('shipper.name', 'like', '%'.$keyword.'%');
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
                'message' => 'Lấy các nhân viên shipper thất bại',
            ], 500);
        }
    }

    public function getShipper($id)
    {
        $data = DB::table('shippers')
                    ->leftJoin('shipping_method', 'shipper.shipping_method_id', '=', 'shipping_method.id');

        $shipper = $data->where('shipper.id',$id);

        try {
            $result = $shipper->get();

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
        $request->only([
            'name',
            'email',
            'phone',
            'avatar',
            'address',
        ]);

        try {
            DB::table('shippers')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'avatar' => $request->avatar,
                'address' => $request->address,
                'shipping_method_id' => $request->shipping_method_id
            ]);
            return response()->json(['message' => 'Thêm mới nhân viên shipper thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới nhân viên shipper thất bại', 'error' => $e], 500);
        }
    }

    public function updateShipper(ShipperRequest $request,$id)
    {
        $request->only([
            'name',
            'email',
            'phone',
            'avatar',
            'address',
        ]);

        try {
            $shipper = DB::table('shippers')->where('id', $id)->first();

            if (isset($shipper)) {
                DB::table('shippers')->where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'avatar' => $request->avatar,
                    'address' => $request->address,
                    'shipping_method_id' => $request->shipping_method_id
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
            $shipper = DB::table('shippers')->where('id', $id)->first();

            if (isset($shipper)) {
                DB::table('shippers')->where('id', $id)->update([
                    'state' => 9,
                ]);
                return response()->json(['message' => 'Xoá nhân viên shipper thành công'], 200);
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
}
