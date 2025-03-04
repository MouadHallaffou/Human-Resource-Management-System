<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    /** @use HasFactory<\Database\Factories\DepartementFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'company_id',
        'responsable_id',
    ];

    /**
     * Relation avec le modèle User (responsable du département).
     */
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    /**
     * Relation avec le modèle Company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relation avec le modèle User (employés du département).
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    /**
     * Relation avec le modèle joob
     */
    public function joobs()
    {
        return $this->hasMany(Joobs::class, 'department_id');
    }
    
}
