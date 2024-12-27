<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        // Logika untuk menyimpan tugas
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->class_id = $request->class_id;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function index()
    {
        // Menampilkan daftar tugas
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

}
