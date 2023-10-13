<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public $timestamps = false;

    public function tasks() {
        return $this->hasMany(Task::class)->orderBy('priority', 'asc')->orderBy('id', 'desc')->get();
    }
}
