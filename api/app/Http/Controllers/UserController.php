<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use DB;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  /**
   * constructor
   */
  public function __construct()
  {
    $this->middleware('jwt.auth', ['except' => ['create']]);
  }

  public function get()
  {
    return response()->json(['user' => 'hogehoge']);
  }

  /**
   * create user api
   */
  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:50|min:5',
      'email' => 'required|email',
      'password' => 'required|max:50|min:5',
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => 'NG', 'message' => "Bad Request. Validation Error."]);
    }

    // データ取得
    $input = $request->only(['name', 'email', 'password']);

    // DBに問い合わせ
    $users = DB::table('users')->where('email', $input["email"])->get();

    // 存在すれば新規ユーザではない
    if(is_array($users) && array_key_exists("0", $users)) {
      if(is_object($users[0])) {
        return response()->json(['status' => 'NG', 'message' => "Aleady exists"]);
      } else {
        return response()->json(['status' => 'NG', 'message' => "Bad Request"]);
      }
    }

    // DB登録処理
    DB::table('users')->insert(
          ['email' => $input["email"], 'name' => $input["name"], 'password' => bcrypt($input["password"])]
        );

    return response()->json(['status' => 'OK', 'message' => "Success"]);
  }
}
