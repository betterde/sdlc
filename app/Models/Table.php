<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 数据表信息模型
 *
 * Date: 2018/10/28
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class Table extends Model
{
	/**
	 * 定义不可批量填充字段
	 *
	 * @var array
	 * Date: 2018/9/21
	 * @author George
	 */
	protected $guarded = ['id'];

	/**
	 * 获取表字段
	 *
	 * Date: 2018/11/4
	 * @author George
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function fields()
	{
		return $this->hasMany(Field::class, 'table_id', 'id');
	}
}
