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

  /**
   * 自分のできることを取得する
   *
   * @param int $userId
   * @return object
   * @access public
   */
  public function myCanDo($userId)
  {
    try {
      $myCanDo = DB::select('select d.name, uc.level from users as u inner join user_cando as uc on u.id = uc.user_id inner join doit as d on uc.doit_id = d.doit_id where u.id = ?', [$userId]);
    } catch(Exception $e) {
      return false;
    }
    return $myCanDo;
  }
}
