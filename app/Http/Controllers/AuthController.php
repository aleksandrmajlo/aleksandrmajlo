<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{


    //войти в логин после
    public $loginAfterSignUp = false;

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed',
            'name'  => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->status = 1;
        //$user->password = bcrypt($request->password);
        $user->password = $request->password;
        $user->save();

        $token = auth()->login($user);
        return response()->json([
            'status' => 'success'
        ], 200)->header('Authorization', $token);

    }

    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'  => 'required|string',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $credentials=['email' => $request->email, 'password' => $request->password, 'status' => 1];
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json([
                'status' => 'success'
            ], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'user' => $user
        ]);
    }

    public function refresh()
    {
        try{
            if ($token = $this->guard()->refresh()) {
                return response()
                    ->json(['status' => 'successs'], 200)
                    ->header('Authorization', $token);
            }
            return response()->json(['error' => 'refresh_token_error'], 401);
        }
        catch (JWTException $e) {
            return response()->json(['error' => 'refresh_token_error'], 401);
        }
    }

    private function guard()
    {
        return Auth::guard();
    }



}
