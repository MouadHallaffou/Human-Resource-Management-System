<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    /** @use HasFactory<\Database\Factories\ContractFactory> */
    use HasFactory;

    protected $fillable = [
        'typeContract',
        'document',
        'startDate',
        'endDate',
    ];

     /**
     * Convertit startDate en objet Carbon.
     */
    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value); 
    }

    /**
     * Convertit endDate en objet Carbon.
     */
    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null; 
    }
}
