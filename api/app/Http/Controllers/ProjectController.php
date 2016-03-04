<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
    $this->middleware('jwt.auth', ['except' => ['get']]);
    $this->projects = $projects;
  }

  /**
   * 自分がアサインしているプロジェクト取得 API
   *
   * @desc /me/projects
   */
  public function myProject()
  {
    $loginUser = JWTAuth::parseToken()->toUser();
    if(!is_object($loginUser)) {
      return response()->json(['status' => 'ng', 'message' => 'auth error.']);
    }

    $projects = $this->projects->findMyProjects($loginUser->id);

    return response()->json(['status' => 'ok', 'projects' => $projects]);
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
    if(is_null($projectId)){
      return response()->json(['project' => 'list']);
    } else {

      // プロジェクトIDに紐付くデータ取得
      $project = $this->projects->findProject($projectId);
      if($project === false || empty($project)) {
        return response()->json(['status' => 'ng', 'message' => 'get data miss.']);
      }

      return response()->json(['status' => 'ok', 'project' => $project]);
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
    $projectId = $this->projects->createProject($postData);
    if($projectId === false) {
      return response()->json(['status' => 'ng', 'message' => 'create project miss.']);
    }

    return response()->json(['status' => 'ok', 'projectId' => $projectId]);
  }
}
