<?php
/**
 * Projectのデータ取得系Model
 *
 * @desc
 * @link
 * @author
 */

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
  /**
   * プロジェクトをデータから探す
   *
   * @param 
   * @return array
   * @access public
   */
  public function searchProjectList()
  {
  }

  /**
   * 自分がアサインされているプロジェクトのリストを取得する
   *
   * @param int $userId
   * @return array
   * @access public
   */
  public function findMyProjectList($userId)
  {
  }

  /**
   * 指定したProjectのデータを取得する
   *
   * @param int $id : project_id
   * @return array
   * @access public
   */
  public function findProject($id)
  {
    $project = array();

    try {
      $project = DB::table('projects')->where('id', $id)->first();
    } catch(Exception $e) {
      return false;
    }

    return $project;
  }

  /**
   * 新規にプロジェクトを作成する
   *
   * @param array $projectData
   * @return boolean
   * @access public
   */
  public function createProject(array $projectData)
  {
    //error_log(var_export($insertData, true), 3, "/tmp/errors2.log");

    DB::beginTransaction();

    try {
      // プロジェクト作成
      $date = date("Y-m-d H:i:s");
      $projectId = DB::table('projects')->insertGetId([
        'name' => $projectData["name"],
        'description' => $projectData["description"],
        'access' => $projectData["access"],
        'goal_description' => $projectData["goal_description"],
        'good_sum' => 0,
        'created_at' => $date,
        'updated_at' => $date
      ]);

      DB::table('project_members')->insert(
        ['project_id' => $projectId, 'user_id' => 1, 'created_at' => $date, 'updated_at' => $date]
      );
    } catch(Exception $e) {
      DB::rollBack();
      return false;
    }

    DB::commit();

    return $projectId;
  }

  /**
   * 既存のプロジェクトを更新する
   *
   * @param int $projectId
   * @param array $projectData
   * @return boolean
   * @access public
   */
  public function updateProject($projectId, array $projectData)
  {
    return true;
  }
}
