<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use DB;
use Validator;
use App\Http\Requests;
use App\Models\Requests as Req;

class RequestController extends Controller
{
  /**
   * Models/Requests model class object
   */
  private $_requestsModelObj = null;

  /**
   * construct
   *
   * @param object $requests
   * @access public
   */
  public function __construct(Req $requests)
  {
    $this->middleware('jwt.auth');
    $this->_requestsModelObj = $requests;
  }

  /**
   *
   */
  public function get($requestId)
  {
  }

  /**
   * 自分のリクエスト一覧取得
   *
   * @desc
   *  /me/requests
   * @param
   */
  public function myRequests()
  {
  }

  /**
   * ユーザーが届いたリクエストを読んだらread_statusを1にする
   */
  public function read($requestId, $status)
  {
  }

  /**
   * 届いたリクエストに対して返信する
   */
  public function response()
  {
  }

  /**
   * リクエスト作成
   */
  public function create(Request $request)
  {
    $input = $request->only(['from_user_id', 'to_user_id', 'to_message']);

    // 作成
    $requestId = $this->requests->createRequests($input);
    if($requestId === false) {
      return response()->json(['status' => 'ng', 'message' => 'create request miss.']);
    }

    return response()->json(['status' => 'ok', 'requestId' => $requestId]);
  }
}
