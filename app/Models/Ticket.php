<?php

namespace App\Models;

use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    use Sortable;

    protected $guarded = ['id'];
    public $sortable = ['id', 'subject', 'user_id', 'status_id', 'category_id', 'created_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, fn($query, $search) => $query->where('subject', 'like', '%'.$search.'%'));

        // dd($filters);
        if ((isset($filters['status_start']) && isset($filters['status_end'])) ? ($filters['status_start'] && $filters['status_end']) : false) {
            return $query->whereBetween('created_at', [\Carbon\Carbon::parse($filters['status_start'])->format('Y-m-d H:i:s'), \Carbon\Carbon::parse($filters['status_end'])->endOfDay()->format('Y-m-d H:i:s')]);
        }

        if ((isset($filters['category_start']) && isset($filters['category_end'])) ? ($filters['category_start'] && $filters['category_end']) : false) {
            return $query->whereBetween('created_at', [\Carbon\Carbon::parse($filters['category_start'])->format('Y-m-d H:i:s'), \Carbon\Carbon::parse($filters['category_end'])->endOfDay()->format('Y-m-d H:i:s')]);
        }

        if ((isset($filters['ticket_div_start']) && isset($filters['ticket_div_end'])) ? ($filters['ticket_div_start'] && $filters['ticket_div_end']) : false) {
            return $query->whereBetween('created_at', [\Carbon\Carbon::parse($filters['ticket_div_start'])->format('Y-m-d H:i:s'), \Carbon\Carbon::parse($filters['ticket_div_end'])->endOfDay()->format('Y-m-d H:i:s')]);
        }

        if ((isset($filters['closed_start']) && isset($filters['closed_end'])) ? ($filters['closed_start'] && $filters['closed_end']) : false) {
            return $query->whereBetween('closed_at', [\Carbon\Carbon::parse($filters['closed_start'])->format('Y-m-d H:i:s'), \Carbon\Carbon::parse($filters['closed_end'])->endOfDay()->format('Y-m-d H:i:s')]);
        }
    }
}
