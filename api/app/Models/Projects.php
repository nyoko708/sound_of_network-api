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
   * @param 
   * @return array
   * @access public
   */
  public function findMyProjectList()
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


}
