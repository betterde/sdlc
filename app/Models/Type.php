<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 项目类型数据模型
 *
 * Date: 2018/9/21
 * @author George
 * @package App\Models
 */
class Type extends Model
{
    use SoftDeletes;
}
