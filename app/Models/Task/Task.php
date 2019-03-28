<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Utils\Url;
use User;
use DB;
use App\Models\User\UserViewedTask;

class Task extends Model
{
    protected $fillable = ['original_url', 'type'];

    public function getUrlAttribute()
    {
        return Url::vk($this->shortened_url);
    }

    /**
     * Накручено тобой
     */
    public function completed()
    {
        return $this->hasMany(CompletedTask::class, 'task_id_from');
    }

    /**
     * Поставлено тебе
     */
    public function received()
    {
        return $this->hasMany(CompletedTask::class, 'task_id_to');
    }

    /**
     * Оставлено жалоб
     */
    public function reports()
    {
        return $this->hasMany(TaskReport::class);
    }

    /**
     * Задачи, которые можно показывать
     *
     * всего накручено = все записи, где task_id=task_id_from
     * уже поставлено = все записи, где task_id=task_id_to
     * Условие активности задачи: всего - уже поставлено > 0
     *
     * Так же жалоб на задачу должно быть меньше 5
     */
    public function scopeActive($query)
    {
        return $query
            ->whereRaw("
                (select count(*) from completed_tasks where task_id_from = tasks.id) -
                (select count(*) from completed_tasks where task_id_to = tasks.id) > 0 AND
                (select count(*) from task_reports where task_id = tasks.id) < 5
            ");
    }

    /**
     * Задачи, которые ещё не отображались пользователю
     */
    public function scopeNotSeen($query)
    {
        return $query
            ->leftJoin('user_viewed_tasks as uwt', function($join) {
                $join->on('uwt.task_id', '=', 'tasks.id')
                    ->where('uwt.user_id', '=', User::id());
            })
            ->whereNull('uwt.task_id');
    }

    /**
     * Задачи за исключением своих
     */
    public function scopeExcludeOwn($query)
    {
        return $query->where('tasks.user_id', '<>', User::id());
    }

    /**
     * Просмотреть задачу
     */
    public function view()
    {
        UserViewedTask::create([
            'task_id' => $this->id,
            'user_id' => User::id(),
        ]);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->shortened_url = Url::shorten($model->original_url);
            $model->user_id = User::id();
        });
    }
}
