<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 项目配置环境数据模型
 *
 * Date: 2018/10/15
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class Environment extends Model
{
	/**
	 * 定义不可批量填充字段
	 *
	 * @var array $guarded
	 * Date: 2018/9/21
	 * @author George
	 */
	protected $guarded = ['id'];

	/**
	 * 定义属性数据类型
	 *
	 * @var array $casts
	 * Date: 2019-02-03
	 * @author George
	 */
	protected $casts = [
		'configuration' => 'json'
	];
}
