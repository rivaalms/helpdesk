<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    // protected $primaryKey = 'user_id';
    
    protected $fillable = ['user_id', 'departement_id', 'created_at', 'updated_at'];

    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function user_role() {
    //     return $this->belongsTo(UserRole::class);
    // }

    public function departement() {
        return $this->belongsTo(Departement::class);
    }
}
