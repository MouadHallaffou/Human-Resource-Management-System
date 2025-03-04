<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joobs extends Model
{
    /** @use HasFactory<\Database\Factories\JoobsFactory> */
    use HasFactory;
    protected $table = 'joobs';

    protected $fillable = [
        'title',
        'description',
        'department_id',
    ];

    // Relation avec le modèle Department
    public function department()
    {
        return $this->belongsTo(Departement::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
