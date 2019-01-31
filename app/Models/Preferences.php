<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 系统配置数据模型
 *
 * Date: 2018/10/20
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class Preferences extends Model
{
	/**
	 * 定义主键名称
	 *
	 * @var string
	 * Date: 2018/10/21
	 * @author George
	 */
	protected $primaryKey = 'name';

	/**
	 * 定义主键类型
	 *
	 * @var string
	 * Date: 2018/10/21
	 * @author George
	 */
	protected $keyType = 'string';

	/**
	 * 定义可填充字段
	 *
	 * @var array
	 * Date: 2018/9/21
	 * @author George
	 */
	protected $fillable = ['value'];

	/**
	 * 定义属性数据类型
	 *
	 * @var array
	 * Date: 2018/10/21
	 * @author George
	 */
	protected $casts = [
		'options' => 'json'
	];
}
