<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'ci',
        'phone',
        'age',
        'lat',
        'long',
        'percentage'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
