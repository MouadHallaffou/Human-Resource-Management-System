<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cariere extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'date_position',
        'contract',
        'role',
        'departement',
        'recruitment_date',
        'salary',
        'grade',
    ];

    /**
     * Relation avec le modèle User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le rôle.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role', 'name');
    }

    /**
     * Relation avec le contrat.
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract', 'typeContract');
    }
}
