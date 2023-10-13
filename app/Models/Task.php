<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'priority',
        'project_id'
    ];
    protected $hidden = ['updated_at'];

    public function project() {
        return $this->belongsTo(Project::class);
    }

}
