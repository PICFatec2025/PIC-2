@foreach ($tasks as $task)
    <p>{{ $task->title }} - {{ $task->completed }}</p>
@endforeach