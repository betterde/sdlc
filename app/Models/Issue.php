<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 项目问题数据模型
 *
 * Date: 2018/10/15
 * @author George
 * @package App\Models
 */
class Issue extends Model
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
	 * 获取Issue的评论内容
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
	 */
	public function comments()
	{
		return $this->morphToMany(Comment::class, 'commentable');
	}
}
