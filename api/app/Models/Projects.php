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
   * @param int $id
   * @param string $name
   * @param int $start
   * @param int $limit
   * @return array
   * @access public
   */
  public function searchProjectList($id=null, $name=null, $start=0, $limit=10)
  {
    try {
      $projectList = DB::table('projects')->skip(0)->take(10)->orderBy('id', 'desc')->get();
    } catch(Exception $e) {
      return false;
    }
    return $projectList;
  }

  /**
   * 自分がアサインされているプロジェクトのリストを取得する
   *
   * @param int $userId
   * @return array
   * @access public
   */
  public function findMyProjects($userId)
  {
    try {
      $myProjects = DB::table('projects')
        ->join('project_members', 'projects.id', '=', 'project_members.project_id')
        ->select('projects.*')
        ->where("project_members.user_id", $userId)
        ->skip(0)
        ->take(10)
        ->orderBy('id', 'desc')
        ->get();
    } catch(Exception $e) {
      return false;
    }
    return $myProjects;
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
   * プロジェクトIDからプロジェクトメンバーを返す
   */
  public function findProjectMembers($projectId)
  {
    try {
      $count = DB::table('project_members')
                ->leftJoin('users', 'project_members.user_id', '=', 'users.id')
                ->select('users.id', 'users.name', 'users.image_file_name')
                ->where('project_members.project_id', $projectId)
                ->orderBy('users.id', 'desc')
                ->count();


      $members = DB::table('project_members')
                  ->leftJoin('users', 'project_members.user_id', '=', 'users.id')
                  ->select('users.id', 'users.name', 'users.image_file_name')
                  ->where('project_members.project_id', $projectId)
                  ->orderBy('users.id', 'desc')
                  ->get();
    } catch(Exception $e) {
      return false;
    }

    return array( "allcount" => $count, "members" => $members );
  }

  /**
   * 新規にプロジェクトを作成する
   *
   * @param array $projectData
   * @return boolean
   * @access public
   */
  public function createProject(array $projectData, $userId)
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
        ['project_id' => $projectId, 'user_id' => $userId, 'created_at' => $date, 'updated_at' => $date]
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
