<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * API响应数据模型
 *
 * Date: 2018/10/28
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class Response extends Model
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
	 * 获取响应头
	 *
	 * Date: 2019-01-26
	 * @author George
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function headers()
	{
		return $this->morphMany(Header::class, 'scene');
	}

    /**
     * 获取响应参数
     *
     * Date: 2019-01-26
     * @author George
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function arguments()
    {
        return $this->morphMany(Argument::class, 'scene');
	}
}
