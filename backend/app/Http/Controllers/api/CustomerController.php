<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\ProductRequest;

class CustomerController extends Controller
{
    public function getAllCustomers(Request $request)
    {
        $data = DB::table('customers');

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
                'message' => 'Lấy danh sách khách hàng thất bại',
            ], 500);
        }
    }

    public function getCustomer($id)
    {
        $data = DB::table('customers');

        $customer = $data->where('id',$id);

        try {
            $result = $customer->get();

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Lấy khách hàng thất bại',
            ], 500);
        }
    }

    public function createCustomer(CustomerRequest $request)
    {
        $request->only([
            'customer_email' ,
            'password' ,
            'customer_name' ,
            'avatar' ,
            'customer_gender',
            'customer_birthday' ,
            'customer_phone' ,
            'customer_address',
            'customer_address_company',
        ]);

        try {

            $customers = DB::table('customers');

            $customers->insert([
                'Customer_name' => $request->Customer_name,
                'Customer_code' => $request->Customer_code,
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
            return response()->json(['message' => 'Thêm mới khách hàng thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới khách hàng thất bại', 'error' => $e], 500);
        }
    }

    public function updateCustomer(CustomerRequest $request,$id)
    {
        $request->only([
            'Customer_name' ,
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
            $customer = DB::table('customers')->where('id', $id)->first();

            if (isset($customer)) {
                DB::table('customers')->where('id', $id)->update([
                    'Customer_name' => $request->Customer_name,
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
                return response()->json(['message' => 'Cập nhật khách hàng thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy khách hàng'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Cập nhật khách hàng thất bại', 'error' => $e], 500);
        }
    }

    public function deleteCustomer($id)
    {
        try {
            $customer = DB::table('customers')->where('id', $id)->first();

            if (isset($customer)) {
                DB::table('customers')->where('id', $id)->update([
                    'state' => 9,
                ]);
                return response()->json(['message' => 'Xoá khách hàng thành công'], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy khách hàng'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Xoá khách hàng thất bại', 'error' => $e], 500);
        }
    }
}
