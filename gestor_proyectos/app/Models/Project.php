<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

    // Relación: un proyecto tiene muchas tareas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relación: un proyecto pertenece a un creador (usuario)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relación: muchos usuarios pueden colaborar en muchos proyectos
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('role', 'joined_at')
                    ->withTimestamps();
    }
}
