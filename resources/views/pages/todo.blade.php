<?php

use function Livewire\Volt\{state, rules, computed};

state([
    'content' => '',
]);

rules([
   'content' => [
     'required',
     'min:3',
     'max:100',
   ],
]);

$addTodo = function () {
    $this->validate();

    \App\Models\Todo::create([
       'content' => $this->content,
    ]);

    $this->content = '';
};

$count = computed(
    fn () => \App\Models\Todo::count(),
);

$todos = computed(
    fn () => \App\Models\Todo::get(),
);
?>

@extends('layouts.app')

@section('content')
    @volt('todo')
    <div>
        Tâches enregistrées : {{ $this->count }}
        <form wire:submit.prevent="addTodo">
            <label for="content">
                <input type="text" id="content" wire:model="content">
            </label>
            <button type="submit">
                Ajouter la tâche
            </button>
        </form>

        @error('content')
        <span>{{ $message }}</span>
        @enderror

        <hr>

        @foreach($this->todos as $todo)
            {{ $todo->content }} <br>
        @endforeach
    </div>
    @endvolt
@endsection
