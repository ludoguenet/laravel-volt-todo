<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('todo');

    $component
        ->assertSet('content', '')
        ->assertSee('Ajouter la tâche')
        ->set('content', fake()->text(40))
        ->call('addTodo')
        ->assertSet('content', '')
        ->assertSet('count', 1);
});
