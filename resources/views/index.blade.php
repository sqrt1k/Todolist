<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <style>
        .completed { text-decoration: line-through; color: #888; }
        .user-info { float: right; }
    </style>
</head>
<body>
     <div class="user-info">
        Привет, {{ auth()->user()->name }}!
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Выйти</button>
        </form>
    </div>
    <h1>To-Do List</h1>
    
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Новая задача">
        <button type="submit">Добавить</button>
    </form>
    
    <ul>
        @foreach ($tasks as $task)
            <li class="{{ $task->completed ? 'completed' : '' }}">
                <form action="{{ route('tasks.update', $task) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <input 
                        type="checkbox" 
                        onChange="this.form.submit()" 
                        {{ $task->completed ? 'checked' : '' }}
                    >
                    {{ $task->title }}
                    | Дата создания: {{ $task->created_at }}
                   
                </form>
                
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Удалить</button>
                </form>
            </li>
        @endforeach
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </ul>
</body>
</html>