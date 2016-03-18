<?php
/**
 * User関連のDBのデータ操作Model
 */

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
  /**
   * リクエスト取得
   */
  public function findMyRequests($userId)
  {
    $requests = array();

    try {
      $sendRequests = DB::table('requests')->where("from_user_id", $userId)->skip(0)->take(10)->orderBy('requests_id', 'desc')->get();
      $receiveRequests = DB::table('requests')->where("to_user_id", $userId)->skip(0)->take(10)->orderBy('requests_id', 'desc')->get();
    } catch(Exception $e) {
      return false;
    }

    $requests["send"] = $sendRequests;
    $requests["receive"] = $receiveRequests;

    return $requests;
  }

  /**
   *
   */
  public function findMySendRequest($userId, $requestId)
  {
    try {
      $request = DB::table('requests')->where('from_user_id', $userId)->where('requests_id', $requestId)->get();
    } catch(Exception $e) {
      return false;
    }

    return $request;
  }

  /**
   *
   */
  public function findMyReceiveRequest($userId, $requestId)
  {
    try {
      $request = DB::table('requests')->where('to_user_id', $userId)->where('requests_id', $requestId)->get();
    } catch(Exception $e) {
      return false;
    }

    return $request;
  }

  /**
   * 読んだステータスをupdateする
   *
   * @desc
   */
  public function updateReadStatus()
  {
  }

  /**
   * レスポンスステータスをupdateする
   *
   */
  public function updateResponseStatus()
  {
  }

  /**
   * リクエストを作成
   */
  public function createRequest($fromUserId, $toUserId, $toMessage)
  {
    $date = date("Y-m-d H:i:s");

    try {
      $id = DB::table('requests')->insertGetId([
              'from_user_id' => $fromUserId,
              'to_user_id' => $toUserId,
              'message' => $toMessage,
              'read_status' => 0,
              'created_at' => $date,
              'updated_at' => $date
            ]);
    } catch(Exception $e) {
      return false;
    }

    return $id;
  }
}
