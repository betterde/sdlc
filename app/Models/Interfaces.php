<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 项目接口数据模型
 *
 * Date: 2018/10/27
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class Interfaces extends Model
{
    /**
     * 正常状态
     */
    const STATUS_NORMAL = 'normal';

    /**
     * 已废弃状态
     */
    const STATUS_DEPRECATED = 'deprecated';

	/**
	 * 定义不可批量填充字段
	 *
	 * @var array
	 * Date: 2018/9/21
	 * @author George
	 */
	protected $guarded = ['id'];

	/**
	 * 获取接口的请求信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function requests()
	{
		return $this->hasMany(Request::class, 'interface_id', 'id');
	}

    /**
     * 获取接口的响应结果
     *
     * Date: 2019-01-26
     * @author George
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responses()
    {
        return $this->hasMany(Response::class, 'interface_id', 'id');
	}

    /**
     * 获取接口的参数信息
     *
     * Date: 2019-01-26
     * @author George
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function arguments()
    {
        return $this->hasMany(Argument::class, 'interface_id', 'id');
	}
}
