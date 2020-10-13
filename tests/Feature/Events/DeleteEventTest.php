<?php

use App\Http\Livewire\Events\DeleteEventModal;
use App\Models\Event;
use function Pest\Livewire\livewire;

it('can delete an event', function () {
    $event = Event::factory()->create();

    livewire(DeleteEventModal::class)
        ->emit('delete', $event)
        ->call('delete');

    $this->assertFalse(Event::whereId($event->id)->exists());
});
