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
      $res = DB::table('users')
              ->leftjoin('user_area', 'users.id', '=', 'user_area.user_id')
              ->leftJoin('area', 'user_area.area_id', '=', 'area.id')
              ->select('users.id', 'users.name', 'users.description', 'users.image_file_name', 'user_area.area_id', 'area.area_name')
              ->skip(0)->take(10)->orderBy('id', 'desc')->get();
    } catch(Exception $e) {
      return false;
    }

    $users = array();
    $areas = array();
    foreach($res as $obj) {
      $vars = get_object_vars($obj);
      $areas[$vars["id"]][] = array( "area_id" => $vars["area_id"], "area_name" => $vars["area_name"] );
      unset($vars["area_id"]);
      unset($vars["area_name"]);
      $users[$vars["id"]] = $vars;
    }

    $response = array();
    foreach($users as $userId => $value) {
      $value["area"] = $areas[$userId];
      $response[] = $value;
    }


    return $response;
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
      $myData = DB::table('users')
                  ->select('id', 'name', 'description', 'image_file_name')
                  ->where('id', $userId)->get();

      $myArea = DB::table('user_area')
                  ->leftJoin('area', 'user_area.area_id', '=', 'area.id')
                  ->select('user_area.area_id', 'area.area_name')
                  ->where('user_area.user_id', $userId)
                  ->get();
    } catch(Exception $e) {
      return false;
    }

    $response = array();
    if(!empty($myData)) {
      foreach($myArea as $value) {
        $myData[0]->area[] = $value;
      }
      $response = $myData;
    }

    return $response;
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
