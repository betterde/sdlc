<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

/**
 * 用户数据模型
 *
 * Date: 2018/10/15
 * @author George
 * @package App\Models
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmailContract, JWTSubject
{
    use Notifiable, SoftDeletes, MustVerifyEmail;

    /**
     * 禁用 Remember Token
     *
     * @var string
     * Date: 2018/10/14
     * @author George
     */
    protected $rememberTokenName = '';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array $fillable
	 * Date: 2019-01-31
	 * @author George
	 */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array $hidden
	 * Date: 2019-01-31
	 * @author George
	 */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 定义JWT获取用户信息的主键
     *
     * Date: 2018/10/14
     * @author George
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 定义需要添加到Payload的内容
     *
     * Date: 2018/10/14
     * @author George
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

	/**
	 * 加密用户密码
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param $value
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
    }

	/**
	 * 获取用户参与的项目
	 *
	 * Date: 2018/10/28
	 * @author George
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function projects()
	{
		return $this->belongsToMany(Project::class, 'project_member_pivot', 'user_id', 'project_id', 'id', 'id');
    }
}
