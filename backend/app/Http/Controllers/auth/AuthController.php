<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;
use Validator;
use App\Models\User;
use Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'account_id' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $success = $user->createToken('user')->plainTextToken;

        $response = [
            'success' => true,
            'token' => $success,
            'message' => 'Người dùng đăng ký thành công',
        ];

        return response()->json($response,200);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'account_id' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = $user->createToken('main')->plainTextToken;

            $response = [
                'success' => true,
                'token' => $token,
                'message' => 'Đăng nhập thành công',
            ];

            return response()->json($response,200);
        }else {
            $response = [
                'success' => false,
                'message' => 'Đăng nhập thất bại',
            ];
            return response()->json($response,400);
        }
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->delete();

        $response = [
            'success' => true,
            'message' => 'Đăng xuất thành công',
        ];

        return response()->json($response, 200);
    }
}
