<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
{
    /** @use HasFactory<\Database\Factories\FormationFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'certificate',
        'start_date',
        'end_date',
    ];

    // Accesseur pour start_date
    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    // Accesseur pour end_date
    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
        
}

