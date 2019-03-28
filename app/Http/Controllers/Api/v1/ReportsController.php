<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task\TaskReport;

class ReportsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'task_id' => ['required', 'exists:tasks,id']
        ]);
        TaskReport::create(['task_id' => $request->task_id]);
    }
}
