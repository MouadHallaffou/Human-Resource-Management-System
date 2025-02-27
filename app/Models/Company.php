<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'logo',
        'address',
        'email',
        'phone',
    ];

    /**
     * Relation avec le modèle Departement.
     */
    public function departements()
    {
        return $this->hasMany(Departement::class);
    }
}