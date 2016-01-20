<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthenticateController extends Controller
{
  /**
   * constructor
   */
  public function __construct()
  {
    $this->middleware('jwt.auth', ['except' => ['auth']]);
  }

  /**
   * ユーザー情報取得API
   */
  public function get()
  {
    // ログイン中のユーザー取得
    $loginUser = JWTAuth::parseToken()->toUser();
    return response()->json(['user' => $loginUser]);
  }

  /**
   * 認証API
   */
  public function auth(Request $request){
    $credentials = $request->only('email', 'password');
    try {
      // verify the credentials and create a token for the user
      if (! $token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'invalid credentials'], 401);
      }
    } catch (JWTException $e) {
      // something went wrong
      return response()->json(['error' => 'could not create token'], 500);
    }

    return response()->json(compact('token'));
  }
}
