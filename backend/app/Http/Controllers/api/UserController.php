<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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
}
