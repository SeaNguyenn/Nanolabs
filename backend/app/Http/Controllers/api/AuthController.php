<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;
use DB;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'account_id' => 'required',
            'email' => 'required | email',
            'password' => 'required',
        ]);

        dd($validator);
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

        $success['tonken'] = $user->createToken('MyApp')->plainTextToken;
        $success['account_id'] = $user->account_id;

        $response = [
            'success' => true,
            'data' => $success,
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

            $success['tonken'] = $user->createToken('main')->plainTextToken;
            $success['account_id'] = $user->account_id;

            $response = [
                'success' => true,
                'data' => $success,
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

    public function logout()
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
