<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // protected $primaryKey = 'user_id';
    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function user_role() {
    //     return $this->belongsTo(UserRole::class);
    // }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
