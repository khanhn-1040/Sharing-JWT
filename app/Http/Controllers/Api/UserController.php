<?php

namespace App\Http\Controllers\Api;

use Auth;
use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select(['name', 'email'])->get();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $users
        ]);
    }

    public function show()
    {
        $user = JWTAuth::user();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $user
        ]);
    }
}
