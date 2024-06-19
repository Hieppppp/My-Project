<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'date_of_birth',
        'end_date',
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
