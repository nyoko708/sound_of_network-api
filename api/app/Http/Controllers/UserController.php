<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use DB;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
  /**
   * User Model のインスタンスを格納する
   */
  private $_userModelObj = null;

  /**
   * constructor
   */
  public function __construct(User $user)
  {
    $this->middleware('jwt.auth', ['except' => ['create']]);

    $this->_userModelObj = $user;
  }

  /**
   * 自分のデータを取得する
   */
  public function myProfile()
  {
    $loginUser = JWTAuth::parseToken()->toUser();
    if(!is_object($loginUser)) {
      return response()->json(['status' => 'ng', 'message' => 'auth error.']);
    }

    $myProfile = $this->_userModelObj->myProfile($loginUser->id);

    return response()->json(['status' => 'ok', 'profile' => $myProfile]);
  }

  /**
   * 指定したIDのUserDataを取得する
   */
  public function get($id=null)
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

    $date = date("Y-m-d H:i:s");

    // DB登録処理
    DB::table('users')->insert(
          ['email' => $input["email"], 'name' => $input["name"], 'password' => bcrypt($input["password"]), 'created_at' => $date, 'updated_at' => $date]
        );

    return response()->json(['status' => 'OK', 'message' => "Success"]);
  }
}
