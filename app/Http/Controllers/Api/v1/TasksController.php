<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task\{Task, CompletedTask};
use App\Http\Requests\Task\StoreRequest;
use App\Http\Resources\Task\TaskResource;
use User;

class TasksController extends Controller
{
    public function index()
    {
        $query = Task::query();
    }

    public function store(StoreRequest $request)
    {
        return new TaskResource(Task::create($request->all())->fresh());
    }

    public function show($id)
    {
        return new TaskResource(
            Task::find($id)
        );
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    /**
     * Получить следующую задачу для пользователя
     * И засчитать лайк предыдущей задачи, если передан completedTask
     */
    public function next(Request $request)
    {
        if (isset($request->completedTask) && $request->completedTask !== null) {
            CompletedTask::insert($request->completedTask);
        }
        $task = Task::active()->notSeen()->excludeOwn()->first();
        $task->view();
        return new TaskResource($task);
    }
}
