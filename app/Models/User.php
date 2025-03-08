<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Departement;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'phone',
        'birthday',
        'address',
        'recruitment_date',
        'salary',
        'status',
        'department_id',
        'contract_id',
        'job_id',
        'grade',
        'jours_recuperation',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function department()
    {
        return $this->belongsTo(Departement::class, 'department_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function joob()
    {
        return $this->belongsTo(Joobs::class, 'job_id');
    }

    public function manager()
    {
        return $this->department ? $this->department->manager : null;
    }

    /**
     * Relation avec les carrières de l'utilisateur
     */
    public function carieres()
    {
        return $this->hasMany(Cariere::class);
    }

    /**
     * Relation avec les formations de l'utilisateur
     */
    public function formations()
    {
        return $this->belongsToMany(Formation::class);
    }
 
}
