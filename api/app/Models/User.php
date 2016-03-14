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
   *
   * @param
   * @return
   * @access
   */
  public function findUserList()
  {
    try {
      $users = DB::table('users')->select('id', 'name', 'email', 'description', 'area_id', 'cando_id')->skip(0)->take(10)->orderBy('id', 'desc')->get();
    } catch(Exception $e) {
      return false;
    }
    return $users;
  }

  /**
   * 自分のプロフィールを取得する
   *
   * @param int $userId
   * @return object
   * @access public
   */
  public function myProfile($userId)
  {
    try {
      $myData = DB::table('users')->where('id', $userId)->get();
    } catch(Exception $e) {
      return false;
    }
    return $myData;
  }
}
