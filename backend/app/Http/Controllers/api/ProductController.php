<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        try {
            $result = DB::table('products')->where('name', 'like', "%{$search}%")
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
                'message' => 'Lấy các sản phẩm thất bại',
            ], 500);
        }
    }

    public function getProduct($id)
    {
        try {
            $result = DB::table('products')->where('id','=',$id)->first();

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
        $data = $request->validated();
        $image = $data['image'] ?? null;

        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
        }

        try {
            DB::table('products')->insert([
                'supplier_id' => $data['supplier_id'],
                'name' => $data['name'],
                'code' => $data['code'],
                'description' => $data['description'],
                'price' => $data['price'],
                'sale_price' => $data['sale_price'],
                'image' => $data['image'],
                'evaluate' => $data['evaluate'],
                'color' => $data['color'],
                'material' => $data['material'],
                'warranty' => $data['warranty'],
                'view_count' => 0,
                'state' => 1,
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['message' => 'Thêm mới sản phẩm thành công'], 200);

        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());
            return response()->json(['message' => 'Thêm mới sản phẩm thất bại', 'error' => $e], 500);
        }
    }

    public function updateProduct(ProductRequest $request,$id)
    {
        $data = $request->validated();
        $product = DB::table('products')->where('id', $id)->first();
        $product->image;

        $image = $data['image'] ?? null;

        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));

            if ($product->image) {
                Storage::deleteDirectory('/public/' . dirname($product->image));
            }
            dd();
        }

        try {
            $product = DB::table('products')->where('id', $id)->first();

            if (isset($product)) {
                DB::table('products')->where('id', $id)->update([
                    'supplier_id' => $data['supplier_id'],
                    'name' => $data['name'],
                    'code' => $data['code'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'sale_price' => $data['sale_price'],
                    'image' => $data['image'],
                    'evaluate' => $data['evaluate'],
                    'color' => $data['color'],
                    'material' => $data['material'],
                    'warranty' => $data['warranty'],
                    'updated_at' => Carbon::now(),
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
                $product = $product->update([
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
