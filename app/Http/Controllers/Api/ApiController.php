<?php

namespace App\Http\Controllers\Api;

use Auth;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->only(['email', 'password']);
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Invalid Email Or Password'
            ]);
        }

        $user = JWTAuth::user();

        return response()->json([
            'status' => Response::HTTP_OK,
            'token' => JWTAuth::claims([
                'admin' => $user->is_admin ? true : false
            ])->attempt($input)
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        try {
            JWTAuth::invalidate(['token' => $token]);

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'User Logged Out Successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Sorry, The User Cannot Be Logged Out',
                'ERROR' => $exception->getMessage()
            ]);
        }
    }
}
