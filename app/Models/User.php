<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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

    protected $dates = ['deleted_at'];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    protected function dobFormat(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::parse($attributes['dob'])->format('d-m-Y'),
            set: fn ($value, $attributes) => Carbon::createFromFormat($attributes['dob'])->format('Y-m-d')
        );
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function postHearts()
    {
        return $this->belongsToMany(Post::class, 'post_hearts', 'user_id', 'post_id');
    }

    public function commentHearts()
    {
        return $this->belongsToMany(Comment::class, 'comment_hearts', 'user_id', 'comment_id');
    }

    public function teacherClasses()
    {
        return $this->hasMany(ChemistryClass::class);
    }

    public function studentClass()
    {
        return $this->belongsTo(Chemistry::class, 'student_id');
    }
}
