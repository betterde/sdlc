<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 项目数据库设计模型
 *
 * Date: 2018/10/28
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class Database extends Model
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
     * 获取数据库的表信息
     *
     * Date: 2018-12-24
     * @author George
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tables()
    {
        return $this->hasMany(Table::class, 'database_id', 'id');
	}
}
