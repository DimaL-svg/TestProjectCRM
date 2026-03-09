<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class Ticket extends Model
{
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
}
