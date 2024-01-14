<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_slug',
        'title',
        'status',
        'description',
        'scheduled_visit',
    ];
}
