<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class CompletedTask extends Model
{
    public $timestamps = false;
    protected $fillable = ['task_id_from', 'task_id_to'];
}
