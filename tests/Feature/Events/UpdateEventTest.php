<?php

use App\Http\Livewire\Events\EditEventModal;
use App\Models\Event;
use Carbon\Carbon;
use function Pest\Livewire\livewire;

it("can update an event's name", function () {
    $event = Event::factory()->state(['name' => 'Bar Night 2000'])->create();

    livewire(EditEventModal::class)
        ->emit('edit', $event)
        ->set('event.name', 'Bar Night 3000')
        ->call('update');

    $event->refresh();
    expect($event->name)->toBe('Bar Night 3000');
});

it("can update an event's start date", function () {
    $event = Event::factory()->state(['starts_at' => Carbon::parse('1 january 2002')])->create();

    livewire(EditEventModal::class)
        ->emit('edit', $event)
        ->set('event.starts_at', Carbon::parse('1 january 2003'))
        ->call('update');

    $event->refresh();
    expect($event->starts_at->equalTo(Carbon::parse('1 january 2003')))->toBeTrue();
});
