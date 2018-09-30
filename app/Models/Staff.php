<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 人员数据模型
 *
 * Date: 2018/9/8
 * @author George
 * @package App\Models
 */
class Staff extends Authenticatable
{
    use HasApiTokens;
}
