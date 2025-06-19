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
        <select name="dayofweek">
            <option value="1">Понедельник</option>
            <option value="2">Вторник</option>
            <option value="3">Среда</option>
            <option value="4">Четверг</option>
            <option value="5">Пятница</option>
            <option value="6">Суббота</option>
            <option value="7">Воскресенье</option>
        </select>
        <button type="submit">Добавить</button>
    </form>
    
    <ul>
        @php
            $lastday = null;
        @endphp

        @foreach ($tasks as $task)
        @if($task->dayofweek != $lastday)
                @if($task->dayofweek==1) Понедельник
                @elseif($task->dayofweek==2) Вторник
                @elseif($task->dayofweek==3) Среда
                @elseif($task->dayofweek==4) Четверг
                @elseif($task->dayofweek==5) Пятница
                @elseif($task->dayofweek==6) Суббота
                @elseif($task->dayofweek==7) Воскресенье
                @endif
            @php $lastday = $task->dayofweek;@endphp
        @endif
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