<?php

namespace App\Models;

use App\Models\Courses;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class User extends Authenticatable implements Auditable, MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, HasJsonRelationships;
    use \OwenIt\Auditing\Auditable;


    /**
     * The database table used by the model.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'contact',
        'stud_num',
        'course_id',
        'email',
        'username',
        'password',
        'is_email_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    // public function notifications()
    // {
    //     return $this->hasMany(Notification::class, 'data->user_id');
    // }
}
