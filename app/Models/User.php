<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];


    protected $guarded = ['id'];
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

    // protected function setKeysForSaveQuery(Builder $query)
    // {
    //     $query
    //         ->where('id', '=', $this->getAttribute('id'))
    //         ->where('user_role_id', '=', $this->getAttribute('user_role_id'));
            
    //     return $query;
    // }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function admins() {
        return $this->hasMany(Admin::class);
    }

    public function workers() {
        return $this->hasMany(Worker::class);
    }

    public function user_role() {
        return $this->belongsTo(UserRole::class);
    }
}
