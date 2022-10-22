<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * @var array|string[]
     */
    public static array $TASK_FILTERS = ['status', 'user_id'];

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     * @param TaskRequest $request
     * @return Task
     */
    public function store(TaskRequest $request)
    {
        return Task::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param TaskRequest $request
     * @return \Illuminate\Support\Collection
     */
    public function show(TaskRequest $request)
    {
        $filters = $request->all();
        $query = DB::table('tasks');

        foreach (self::$TASK_FILTERS as $key) {
            if (array_key_exists($key, $filters)) {
                $query->where($key, $filters[$key]);
            }
        }

        return $query->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function update(TaskRequest $request)
    {
        $task = Task::findOrFail($request['task_id']);
        $task->fill($request->except(['task_id']));
        $task->save();
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TaskRequest $request
     * @return Response
     */
    public function destroy(TaskRequest $request)
    {
        $task = Task::findOrFail($request['task_id']);
        if($task->delete()) return response(null, 204);
    }
}
