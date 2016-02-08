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
  public function searchUser()
  {
  }

  /**
   * 指定したUSER_IDの情報を返す
   *
   */
  public function findProfile($id=null)
  {
  }
}
