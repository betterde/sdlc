<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 系统服务数据模型
 *
 * Date: 2018/10/15
 * @author George
 * @package App\Models
 */
class Service extends Model
{
	/**
	 * 定义不可批量填充字段
	 *
	 * @var array
	 * Date: 2018/9/21
	 * @author George
	 */
	protected $guarded = ['id'];
}
