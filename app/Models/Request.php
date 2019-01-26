<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 接口请求信息
 *
 * Date: 2019-01-26
 * @author George
 * @package App\Models
 */
class Request extends Model
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
     * 获取请求参数
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
