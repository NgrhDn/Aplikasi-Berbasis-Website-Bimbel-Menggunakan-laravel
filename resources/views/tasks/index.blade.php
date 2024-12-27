@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')
    <div class="container">
        <h1>Daftar Tugas</h1>
        <ul>
            @foreach ($tasks as $task)
                <li>{{ $task->title }} - {{ $task->description }}</li>
            @endforeach
        </ul>
    </div>
@endsection
