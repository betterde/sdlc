<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 项目数据模型
 *
 * Date: 2018/10/15
 * @author George
 * @package App\Models
 */
class Project extends Model
{
    use SoftDeletes;

    /**
     * 定义不可批量填充字段
     *
     * @var array
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

	/**
	 * 获取项目成员
	 *
	 * Date: 2018/10/15
	 * @author George
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function members()
	{
		return $this->belongsToMany(User::class, 'project_member_pivot', 'project_id', 'user_id', 'id', 'id')
			->withPivot(['role_id', 'expires', 'remind']);
    }
}
