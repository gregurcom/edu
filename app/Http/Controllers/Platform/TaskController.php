<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Auth::user()->tasks()->orderByRaw('-end_time DESC')->get();

        return view('platform.task.index', compact('tasks'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Task::create(array_merge(['user_id' => Auth::id()], $request->all()));

        return back()->with('status', 'You have successfully create a task');
    }

    public function edit(Task $task): View
    {
        return view('platform.task.edit', compact('task'));
    }

    public function update(Task $task, StoreTaskRequest $request): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()->route('platform.tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return back();
    }
}
