<?php
/**
 * User関連のDBのデータ操作Model
 */

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  /**
   * ユーザーを探す
   *
   * @param
   */
  public function searchUser($userName=null, $start=0, $limit=10)
  {
  }

  /**
   * 指定したUSER_IDの情報を返す
   */
  public function findUser($userId=null)
  {
  }

  public function myProfile($userId)
  {
  }
}
