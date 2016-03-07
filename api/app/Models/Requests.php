<?php
/**
 * User関連のDBのデータ操作Model
 */

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
  public function findMyRequest($myUserId)
  {
  }

  public function createRequest($fromUserId, $toUserId)
  {
  }
}
