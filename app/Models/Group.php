<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * API分组数据模型
 *
 * Date: 2018/10/28
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class Group extends Model
{
    /**
     * 定义场景
     */
    const SCENE_INTERFACE = 'interfaces';

	/**
	 * 定义不可批量填充字段
	 *
	 * @var array
	 * Date: 2018/9/21
	 * @author George
	 */
	protected $guarded = ['id'];

    /**
     * 获取分组下的接口
     *
     * Date: 2019-01-25
     * @author George
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interfaces()
    {
        return $this->hasMany(Interfaces::class, 'group_id', 'id');
	}
}
