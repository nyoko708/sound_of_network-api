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
      $sendRequests = DB::table('requests')
        ->join('users', 'users.id', '=', 'requests.to_user_id')
        ->select('requests.*', 'users.name', 'users.image_file_name')
        ->where("from_user_id", $userId)
        ->skip(0)
        ->take(10)
        ->orderBy('requests_id', 'desc')
        ->get();
      $receiveRequests = DB::table('requests')
        ->join('users', 'users.id', '=', 'requests.from_user_id')
        ->select('requests.*', 'users.name', 'users.image_file_name')
        ->where("to_user_id", $userId)
        ->skip(0)
        ->take(10)
        ->orderBy('requests_id', 'desc')
        ->get();
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
      $request = DB::select('select
                               requests.*,
                               u1.name as to_user_name,
                               u2.name as from_user_name
                             from requests
                             inner join users u1 on requests.to_user_id = u1.id
                             inner join users u2 on requests.from_user_id = u2.id
                             where
                               from_user_id = :id
                             and
                               requests_id = :reqId',
                            ['id' => $userId, 'reqId' => $requestId]);
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
      $request = DB::select('select
                              requests.*,
                              u1.name as to_user_name,
                              u2.name as from_user_name
                             from requests
                             inner join users u1 on requests.to_user_id = u1.id
                             inner join users u2 on requests.from_user_id = u2.id
                             where
                               to_user_id = :id
                             and
                               requests_id = :reqId',
                            ['id' => $userId, 'reqId' => $requestId]);
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
  public function updateReadStatus($toUserId, $requestId)
  {
    try {
      DB::table('requests')
        ->where('to_user_id', $toUserId)
        ->where('requests_id', $requestId)
        ->update(['read_status' => 1]);
    } catch(Exception $e) {
      return false;
    }
    return true;
  }

  /**
   * レスポンスステータスをupdateする
   *
   */
  public function updateResponseStatus($toUserId, $requestId, $statusCode)
  {
    try {
      DB::table('requests')
        ->where('to_user_id', $toUserId)
        ->where('requests_id', $requestId)
        ->update(['response_status' => $statusCode]);
    } catch(Exception $e) {
      return false;
    }
    return true;
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
