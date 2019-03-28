<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserViewedTask extends Model
{
    public $timestamps = false;
    protected $fillable = ['task_id', 'user_id'];
}
