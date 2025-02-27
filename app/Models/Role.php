<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

     /**
     * Relation many-to-many avec le modèle User.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Relation many-to-many avec le modèle Permission.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
