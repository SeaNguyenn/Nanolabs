<?php

namespace App\Http\Controllers\api;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;

class UserController extends Controller
{
    public function getInfo(Request $request)
    {
        $user = $request->user();

        $userKeyCols = Config::get('constants.user_keys');
        $responseData = [];

        foreach (array_keys($userKeyCols) as $key) {
            $responseData[$key] = $user[$userKeyCols[$key]];
        }

        return response()->json(['data' => $responseData]);
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
}
