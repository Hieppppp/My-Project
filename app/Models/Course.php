<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
    ];
    
    /**
     * dates
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date',
    ];
    
    /**
     * users
     *
     * @return BelongsToMany
     */
    public function users() {
        return $this->belongsToMany(User::class);
    }
}
