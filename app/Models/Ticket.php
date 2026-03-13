<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Ticket extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory, Notifiable;
        /**
        * The attributes that are mass assignable.
        *
        * @var list<string>
        */
        protected $fillable = [
        'customer_id',
        'subject',
        'message',
        'status',
        'manager_replied_at',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function scopeDaily($query)
    {
    return $query->where('created_at', '>=', Carbon::now()->subDay());
    }

    public function scopeWeekly($query)
    {
    return $query->where('created_at', '>=', Carbon::now()->subWeek());
    }

    public function scopeMonthly($query)
    {
    return $query->where('created_at', '>=', Carbon::now()->subMonth());
    }
}
