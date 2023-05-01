<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Major;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'majors',
        'phone',
        'email',
        'address',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class , 'majors');
    }



}
