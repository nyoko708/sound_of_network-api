<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Projects;

class ProjectController extends Controller
{
  /**
   * ProjectsModelのインスタンス格納用
   */
  protected $projects = null;

  /**
   * Construct
   */
  public function __construct(Projects $projects)
  {
    $this->middleware('jwt.auth', ['except' => ['get', 'create']]);
    $this->projects = $projects;
  }

  /**
   * /project/{projectId?} API
   *
   * @desc プロジェクトの情報取得API
   * @param int $projectId : プロジェクトID NULLの場合は、リストで返す
   * @return json
   */
  public function get($projectId = null)
  {
    if(!is_null($projectId)){
      return response()->json(['project' => $projectId]);
    } else {
      return response()->json(['project' => 'list']);
    }
  }

  /**
   * /project/create API
   *
   * @desc プロジェクト新規作成 API
   * @param なし
   * @return json
   */
  public function create(Requests\ProjectCreateRequest $request)
  {
    // POST データを受け取る Validationもここでしてます
    $postData = $request->input();

    // 新規登録処理
    $this->projects->createProject($postData);

    return response()->json(['status' => 'ok', 'message' => 'Success Create Project.']);
  }
}
