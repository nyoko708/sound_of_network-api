<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProjectsModel;

class ProjectController extends Controller
{
  /**
   * Construct
   */
  public function __construct()
  {
    $this->middleware('jwt.auth', ['except' => ['get']]);
  }

  /**
   * /project/{projectId?} API
   *
   * @desc プロジェクトの情報取得API
   * @param int $projectId : プロジェクトID NULLの場合は、リストで返す
   * @return array
   */
  public function get($projectId = null)
  {
    if(!is_null($projectId)){
      return response()->json(['project' => $projectId]);
    } else {
      return response()->json(['project' => 'list']);
    }
  }
}
