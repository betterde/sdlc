<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 项目接口数据模型
 *
 * Date: 2018/10/27
 * @author George
 * @package App\Models
 */
class Interfaces extends Model
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
