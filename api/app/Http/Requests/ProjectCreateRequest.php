<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required'
        ];
    }

    public function response(array $errors)
    {
      $headers = [
        'Access-Control-Allow-Origin' =>' *',
      ];

      $response["status"] = "NG";
      $response["message"] = $errors;

      return \Response::json($response,200,$headers);
    }
}
