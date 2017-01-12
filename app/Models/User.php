<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'social_name',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'user_follow_id');
    }

    public function followed()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_follow_id', 'user_id');
    }
    public function isAdmin()
    {
        return $this->attributes['role'] == config('common.auth.role_admin');
    }
}
