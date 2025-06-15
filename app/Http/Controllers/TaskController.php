<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Отображает список всех задач
     */
    public function index()
    {
        $tasks = todolist::orderBy('created_at', 'asc')->get();
        return view('index', compact('tasks'));
    }

    /**
     * Сохраняет новую задачу
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        todolist::create([
            'title' => $validated['title'],
            'completed' => false
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Обновляет статус задачи (выполнено/не выполнено)
     */
    public function update(Request $request, Todolist $task)
    {
        $task->update([
            'completed' => !$task->completed
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Удаляет задачу
     */
    public function destroy(Todolist $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}