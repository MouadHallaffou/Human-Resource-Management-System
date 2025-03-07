<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'total_days',
        'status_manager',
        'status_rh_manager',
        'status_demandeur',
        'cause',
    ];

    // Relation avec l'utilisateur (employé)
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function department()
    {
        return $this->user->department();
    }
}
