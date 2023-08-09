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
    public function getAllProduct(Request $request)
    {
        $perPage = min(request('per_page', 10), 50);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        try {
            $result = DB::table('products')
            ->where('products.name', 'like', "%{$search}%")
            ->where('products.is_active', true)
            ->orderBy('products.'.$sortField, $sortDirection)
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

    public function getAllProductByCategory(Request $request, $categoryId)
    {
        $perPage = min(request('per_page', 10), 50);
        try {

            $products = DB::table('products')
                ->join('category_product', 'products.id', '=', 'category_product.product_id')
                ->where('category_product.category_id', $categoryId)
                ->where('products.is_active', true)
                ->select('products.*')
                ->paginate($perPage);

                return response()->json([
                    'success' => true,
                    'data' => $products,
                ], 200);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json(['error' => 'Đã xảy ra lỗi trong quá trình xử lý.'], 500);
        }
    }

    public function getProduct($id)
    {
        try {
            $result = DB::table('products')
            ->where('products.id',$id)
            ->first();

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
                'warranty' => $data['warranty'],
                'is_active' => true,
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

        $image = $data['image'] ?? null;

        if ($image) {
            if ($product->image) {
                Storage::deleteDirectory('/public' . dirname($product->image));
            }
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
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
            $product = DB::table('products')->where('id', $id);

            if (isset($product)) {
                $product = $product->update([
                    'is_active' => false,
                    'updated_at' => Carbon::now(),
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
