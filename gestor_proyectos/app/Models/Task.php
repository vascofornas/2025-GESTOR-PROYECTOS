<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'project_id',
        'assigned_to',
    ];

    // Relación: una tarea pertenece a un proyecto
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relación: una tarea puede estar asignada a un usuario
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
