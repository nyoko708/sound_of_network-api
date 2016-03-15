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
  public function findMyRequest($myUserId)
  {
  }

  /**
   * リクエストを作成
   */
  public function createRequest($fromUserId, $toUserId, $toMessage)
  {
    $date = date("Y-m-d H:i:s");

    try {

      DB::table('requests')->insert([
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

    return true;
  }
}
