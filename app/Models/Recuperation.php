<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recuperation extends Model
{
    /** @use HasFactory<\Database\Factories\RecuperationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_recuperation',
        'jours_demandes',
        'status',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
