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
        $tasks = Auth::user()->todolists()->orderBy('created_at', 'asc')->paginate(
               $perPage = 10,
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
        ]);

        Auth::user()->todolists()->create([
            'title' => $validated['title'],
            'completed' => false
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