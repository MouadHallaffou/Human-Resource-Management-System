<?php

namespace App\Models;

use Spatie\Permission\Contracts\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    /** @use HasFactory<\Database\Factories\PermissionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relation many-to-many avec le modèle Role.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
}
