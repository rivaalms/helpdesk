<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    // public function scopeFilter($query, array $filters) {
    //     $query->when($filters['search'] ?? false, fn($query, $search) => $query->where('subject', 'like', '%'.$search.'%'));
    // }
}
