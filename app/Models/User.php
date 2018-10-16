<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 用户数据模型
 *
 * Date: 2018/10/15
 * @author George
 * @package App\Models
 */
class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable, SoftDeletes;

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
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
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
}
