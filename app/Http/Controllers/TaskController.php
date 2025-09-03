<?php

namespace App\Http\Controllers;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query()->where('user_id', $request->user()->id);

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $tasks = $query->latest()->paginate($request->integer('per_page', 10));

        return TaskResource::collection($tasks)
            ->additional(['meta' => ['status' => 'ok']]);
    }

    public function store(TaskStoreRequest $request)
    {
        $task = new Task($request->validated());
        $task->user_id = $request->user()->id;
        $task->save();

        return (new TaskResource($task))
            ->additional(['meta' => ['status' => 'created']])
            ->response()
            ->setStatusCode(201);
    }

    public function show(Request $request, Task $task)
    {
        $this->authorizeTask($request, $task);
        return new TaskResource($task);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $this->authorizeTask($request, $task);
        $task->fill($request->validated())->save();
        return (new TaskResource($task))
            ->additional(['meta' => ['status' => 'updated']]);
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorizeTask($request, $task);
        $task->delete();
        return response()->json(['message' => 'deleted']);
    }

    protected function authorizeTask(Request $request, Task $task): void
    {
        abort_if($task->user_id !== $request->user()->id, 403, 'Forbidden');
    }
}
