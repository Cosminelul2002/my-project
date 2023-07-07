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
        'status',
        'description',
    ];

    protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

    public function program()
    {
        return $this->hasMany(Program::class);
    }

    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }
}
