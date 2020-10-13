<?php

use App\Http\Livewire\Events\CreateEventForm;
use App\Models\Event;
use Carbon\Carbon;
use function Pest\Livewire\livewire;

it('can create an event', function () {
    livewire(CreateEventForm::class)
        ->set('name', 'Bar Night Deluxe XXL')
        ->set('starts_at', $startDate = Carbon::parse("1 january 2030"))
        ->set('shifts.0.start_time', '22:00')
        ->set('shifts.0.bartenders', '2')
        ->call('create');

    $event = Event::firstOrFail();
    expect($event->name)->toBe('Bar Night Deluxe XXL');
    expect($event->starts_at->equalTo($startDate))->toBeTrue();
    expect($event->shifts)->toHaveCount(1);
    expect($event->shifts[0]->start_time)->toBe('22:00');
    expect($event->shifts[0]->bartenders)->toBe(2);
});

it('can create an event with multiple shifts', function () {
    livewire(CreateEventForm::class)
        ->set('name', 'Bar Night Deluxe XXL')
        ->set('starts_at', $startDate = Carbon::parse("1 january 2030"))
        ->set('shifts.0.start_time', '22:00')
        ->set('shifts.0.bartenders', '2')
        ->call('addShift')
        ->set('shifts.1.start_time', '00:00')
        ->set('shifts.1.bartenders', '3')
        ->call('addShift')
        ->set('shifts.2.start_time', '02:00')
        ->set('shifts.2.bartenders', '2')
        ->call('create');

    $event = Event::firstOrFail();
    expect($event->shifts)->toHaveCount(3);
    expect($event->shifts[0]->start_time)->toBe('22:00');
    expect($event->shifts[0]->bartenders)->toBe(2);
    expect($event->shifts[1]->start_time)->toBe('00:00');
    expect($event->shifts[1]->bartenders)->toBe(3);
    expect($event->shifts[2]->start_time)->toBe('02:00');
    expect($event->shifts[2]->bartenders)->toBe(2);
});

it('can create an event with multiple shifts where an accidental shift is removed', function () {
    livewire(CreateEventForm::class)
        ->set('name', 'Bar Night Deluxe XXL')
        ->set('starts_at', $startDate = Carbon::parse("1 january 2030"))
        ->set('shifts.0.start_time', '22:00')
        ->call('addShift')
        ->set('shifts.1.start_time', '00:00')
        ->call('removeShift', 1)
        ->call('addShift')
        ->set('shifts.1.start_time', '02:00')
        ->call('create');

    $event = Event::firstOrFail();
    expect($event->shifts)->toHaveCount(2);
    expect($event->shifts[0]->start_time)->toBe('22:00');
    expect($event->shifts[1]->start_time)->toBe('02:00');
});

it('cannot create an event without a name')
    ->livewire(CreateEventForm::class)
    ->set('starts_at', Carbon::parse("1 january 2030"))
    ->set('shifts.0.start_time', '22:00')
    ->call('create')
    ->assertHasErrors('name');

it('cannot create an event without a date')
    ->livewire(CreateEventForm::class)
    ->set('name', 'Bar Night Deluxe XXL')
    ->set('shifts.0.start_time', '22:00')
    ->call('create')
    ->assertHasErrors('starts_at');

it('cannot create an event without shifts')
    ->livewire(CreateEventForm::class)
    ->set('name', 'Bar Night Deluxe XXL')
    ->set('starts_at', Carbon::parse("1 january 2030"))
    ->call('removeShift', 0)
    ->call('create')
    ->assertHasErrors('shifts');

it('cannot create an event with shifts that do not have starting time')
    ->livewire(CreateEventForm::class)
    ->set('name', 'Bar Night Deluxe XXL')
    ->set('starts_at', Carbon::parse("1 january 2030"))
    ->set('shifts.0.start_time', '')
    ->set('shifts.0.bartenders', '2')
    ->call('create')
    ->assertHasErrors('shifts.*.start_time');

it('cannot create an event with shifts that do not have a number of bartenders')
    ->livewire(CreateEventForm::class)
    ->set('name', 'Bar Night Deluxe XXL')
    ->set('starts_at', Carbon::parse("1 january 2030"))
    ->set('shifts.0.start_time', '22:00')
    ->set('shifts.0.bartenders', '')
    ->call('create')
    ->assertHasErrors('shifts.*.bartenders');

it('cannot create an event with shifts that do not have a valid number of bartenders')
    ->livewire(CreateEventForm::class)
    ->set('name', 'Bar Night Deluxe XXL')
    ->set('starts_at', Carbon::parse("1 january 2030"))
    ->set('shifts.0.start_time', '22:00')
    ->set('shifts.0.bartenders', 'invalid-number')
    ->call('create')
    ->assertHasErrors('shifts.*.bartenders');

it('cannot create an event with shifts that have a negative number of bartenders')
    ->livewire(CreateEventForm::class)
    ->set('name', 'Bar Night Deluxe XXL')
    ->set('starts_at', Carbon::parse("1 january 2030"))
    ->set('shifts.0.start_time', '22:00')
    ->set('shifts.0.bartenders', '-1')
    ->call('create')
    ->assertHasErrors('shifts.*.bartenders');
