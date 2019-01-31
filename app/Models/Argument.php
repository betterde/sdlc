<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 项目API请求、响应参数模型
 *
 * Date: 2018/10/28
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class Argument extends Model
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
     * 参数场景
     *
     * Date: 2019-01-26
     * @author George
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function scene()
    {
        return $this->morphTo();
	}

    /**
     * 获取选项的属性
     *
     * Date: 2019-01-26
     * @author George
     * @return array
     */
    public function getOptionsAttributes()
    {
        return [
            'default' => 'boolean',
            'value' => 'string',
            'comment' => 'string'
        ];
	}
}
