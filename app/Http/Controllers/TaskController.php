<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TaskController extends Controller
{

    public function index(): View
    {
        return view('tasks/index', ['tasks' => Task::all()]);
    }


    public function create(): View
    {
        return view('tasks/create');
    }


    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'category' => ['required']
        ]);
        $task = new Task([
            'name' => $attributes['name'],
            'category' => $attributes['category']
        ]);
        $task->user()->associate(auth()->user());
        $task->save();


        return redirect('/tasks')->with('success', 'Task Added!');
    }


    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'category' => ['required']
        ]);
        $task->update([
            'name' => $attributes['name'],
            'category' => $attributes['category']
        ]);

        return Redirect::route('tasks');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks');
    }

    public function complete(Task $task): RedirectResponse
    {
        var_dump($task);
        die;
        $task->update([
            'completed_at' => now()
        ]);

        return redirect()->back();
    }
}
