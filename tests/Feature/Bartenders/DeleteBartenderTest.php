<?php

use App\Http\Livewire\Bartenders\DeleteBartenderModal;
use App\Models\User;
use function Pest\Livewire\livewire;

it('can delete a bartender', function () {
    $user = User::factory()->create();

    livewire(DeleteBartenderModal::class)
        ->emit('delete', $user)
        ->call('delete');

    $this->assertFalse(User::whereId($user->id)->exists());
});
