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
