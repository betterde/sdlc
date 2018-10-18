<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 评论数据模型
 *
 * Date: 2018/10/18
 * @author George
 * @package App\Models
 */
class Comment extends Model
{
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
