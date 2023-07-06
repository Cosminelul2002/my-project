<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'day_of_week',
        'status',
        'description',
    ];

    protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];
}
