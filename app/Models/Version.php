<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 版本数据模型
 *
 * Date: 2018/10/15
 * @author George
 * @package App\Models
 * @property array $guarded
 * @mixin Eloquent
 */
class Version extends Model
{
	use SoftDeletes;

	/**
	 * 定义不可批量填充字段
	 *
	 * @var array $guarded
	 * Date: 2018/9/21
	 * @author George
	 */
	protected $guarded = ['id'];

	/**
	 * 定义隐藏字段
	 *
	 * @var array
	 * Date: 2018/10/18
	 * @author George
	 */
	protected $hidden = ['deleted_at'];
}
