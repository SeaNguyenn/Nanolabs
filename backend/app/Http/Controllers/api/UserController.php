<?php

namespace App\Http\Controllers\api;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;
class UserController extends Controller
{
    public function getInfoUser(Request $request)
    {
        $user = $request->user();

        $userKeyCols = Config::get('constants.user_keys');
        $responseData = [];

        foreach (array_keys($userKeyCols) as $key) {
            $responseData[$key] = $user[$userKeyCols[$key]];
        }
        return response()->json(['data' => $responseData]);
    }


    public function updateInfoUser(Request $request, $id)
    {
        $data = $request->all();
        $image = $data['image'] ?? null;

        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
        }

        try {
            $user = DB::table('users')->where('id', $id);

            $user->update([
                'name' => $data['name'],
                'image' => $data['image'],
                'gender' => $data['gender'],
                'birthday' => $data['birthday'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'result' => true,
                'message' => 'Cập nhật người dùng thành công'
            ]);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'result' => false,
                'message' => 'Cập nhật người dùng không thành công'
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        try {
            $user = DB::table('users')->where('id', $user_id);

            $user->update([
                'password' => $data['password'],
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'result' => true,
                'message' => 'Cập nhật password thành công'
            ]);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'result' => false,
                'message' => 'Cập nhật password không thành công'
            ]);
        }
    }

    public function updateUserRole(Request $request, $id)
    {
        $data = $request->all();
        try {
            $user = DB::table('users')->where('id', $id);

            $user->update([
                'role_id' => $data['role_id'],
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'result' => true,
                'message' => 'Cấp quyền thành công'
            ]);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'result' => false,
                'message' => 'Cấp quyền không thành công'
            ]);
        }
    }

    public function removeUser($id)
    {
        try {
            $user = DB::table('users')->where('id', $id);

            $user->update([
                'is_active' => false,
            ]);

            return response()->json([
                'result' => true,
                'message' => 'Xoá người dùng thành công'
            ]);
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: '.$e->getMessage());

            return response()->json([
                'result' => false,
                'message' => 'Xoá người dùng không thành công'
            ]);
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
