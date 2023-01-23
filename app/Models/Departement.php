<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function workers() {
        return $this->hasMany(Worker::class);
    }

    public function registerrequest() {
        return $this->hasMany(RegisterRequest::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
