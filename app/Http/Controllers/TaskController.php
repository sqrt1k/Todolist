<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()//Отображаем все задачи
    {
        $tasks = Auth::user()->todolists()->orderBy('dayofweek', 'asc')->paginate(
               $perPage = 20,
               $columns = ['*'],
               $pageName = 'tasks_page');
        return view('index', compact('tasks'));
    }

    /**
     * Сохраняет новую задачу
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'dayofweek' => 'required|integer|min:1|max:7'
        ]);

        Auth::user()->todolists()->create([
            'title' => $validated['title'],
            'completed' => false,
            'dayofweek' => $validated['dayofweek']
        ]);

        return redirect()->back()
        ->withInput(request()->except(['_method', '_token']));
    }

    /**
     * Обновляет статус задачи (выполнено/не выполнено)
     */
    public function update(Request $request, Todolist $task)
    {
        $this->authorize('update', $task);
        $task->update([
            'completed' => !$task->completed
        ]);

        return redirect()->back();
    }

    /**
     * Удаляет задачу
     */
    public function destroy(Todolist $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->back();
    }
    public function redirectToTasks()
    {
        return redirect()->route('tasks.index');
    }
}