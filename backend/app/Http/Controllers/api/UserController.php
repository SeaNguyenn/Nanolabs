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
class UserController extends Controller
{
    public function getInfo(Request $request)
    {
        $user = $request->user();

        $userKeyCols = Config::get('constants.user_keys');
        $userRoleCols = Config::get('constants.role_id');
        $responseData = [];

        foreach (array_keys($userKeyCols) as $key) {
            $responseData[$key] = $user[$userKeyCols[$key]];
        }

        $responseData['role_id'] = $userRoleCols[$responseData['role_id']];

        return response()->json(['data' => $responseData]);
    }


    public function updateInfo(Request $request, $id)
    {
        $data = $request->all();
        $image = $data['avatar'] ?? null;

        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['avatar'] = URL::to(Storage::url($relativePath));
        }

        try {
            $user = DB::table('users')->where('id', $id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'avatar' => $data['avatar'],
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

    public function updatePassword(Request $request, $id)
    {
        $data = $request->all();

        try {
            $user = DB::table('users')->where('id', $id)->update([
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

    public function removeUser($id)
    {
        $user_role_id = Auth::user()->role_id;
        if ($user_role_id === 1 || $user_role_id === 2) {
            try {
                $user = DB::table('users')->where('id', $id)->update([
                    'is_active' => 9,
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
        }else {
            return response()->json([
                'message' => 'Bạn không có quyền truy cập'
            ]);
        }
    }

    public function register(Request $request)
    {
        $newUser = new CreateNewUser();

        $user = $newUser->create($request->only(['account_id','email','password','password_confirmation']));
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['user'] = $user;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'Người dùng đăng ký thành công',
        ];

        return response()->json($response,200);
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
