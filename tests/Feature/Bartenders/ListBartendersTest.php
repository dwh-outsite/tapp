<?php

use App\Http\Livewire\Bartenders\BartendersManager;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function () {
   User::factory()->count(10)->create();
   User::factory()->state(['name' => 'Henk de Vries'])->create();
});

test('a guest cannot see the bartenders', function () {
    get(route('bartenders'))
        ->assertRedirect(route('login'));
});

test('a user can see the bartenders', function () {
    actingAs(User::factory()->create());

    get(route('bartenders'))
        ->assertSee('Henk de Vries');
});
