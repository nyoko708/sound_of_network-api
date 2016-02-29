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
    try {

      // プロジェクト作成
      DB::transaction(function()
      {
        $projectId = DB::table('projects')->insertGetId(
          ['name' => 'コンピュータミュージック作成プロジェクト', 'members_id' => 0, 'description' => 'hoeghoegehoegheohoあいうえおかきくけこ', 'access' => 1, 'goal_description' => '', 'good_sum' => 0, 'created_at' => time(), 'updated_at' => time()]
        );

        $projectMemberId = DB::table('project_member')->insertGetId(
          ['project_id' => $projectId, 'user_id' => 1, 'created_at' => time(), 'updated_at' => time()]
        );
      });

    } catch(Exception $e) {
      return false;
    }

    return true;
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
