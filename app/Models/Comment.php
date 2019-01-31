<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 评论数据模型
 *
 * Date: 2018/10/18
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class Comment extends Model
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
	 * 获得拥有此评论的模型
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function commentable()
	{
		return $this->morphTo();
	}
}
