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

//it("can update a bartender's bartending course status", function () {
//    $user = User::factory()->state(['bartending_course' => false])->create();
//
//    livewire(EditBartenderModal::class)
//        ->emit('edit', $user)
//        ->set('user.bartending_course', true)
//        ->set('user.bartending_course_date', $courseDate = Carbon::parse('1 January 2000'))
//        ->call('update');
//
//    $user->refresh();
//    expect($user->bartending_course)->toBeTrue();
//    expect($user->bartending_course_date->equalTo($courseDate))->toBeTrue();
//});
//
//it("can update a bartender's iva certificate status", function () {
//    $user = User::factory()->state(['iva_certificate' => false])->create();
//
//    livewire(EditBartenderModal::class)
//        ->emit('edit', $user)
//        ->set('user.iva_certificate', true)
//        ->call('update');
//
//    $user->refresh();
//    expect($user->iva_certificate)->toBeTrue();
//});
//
//it("can update a bartender's iva certificate", function () {
//    Storage::fake();
//
//    $file = UploadedFile::fake()->create('certificate.pdf');
//
//    $user = User::factory()->state(['iva_certificate' => false])->create();
//
//    livewire(EditBartenderModal::class)
//        ->emit('edit', $user)
//        ->set('user.iva_certificate', true)
//        ->set('iva_certificate_file', $file)
//        ->call('update');
//
//    $user->refresh();
//    expect($user->iva_certificate)->toBeTrue();
//    expect(Storage::disk('tmp-for-tests')->exists($user->iva_certificate_file))->toBeTrue();
//});
//
//it("cannot update a bartender's iva certificate to be a non-pdf", function () {
//    Storage::fake();
//
//    $file = UploadedFile::fake()->create('certificate.exe');
//
//    $user = User::factory()->state(['iva_certificate' => false])->create();
//
//    livewire(EditBartenderModal::class)
//        ->emit('edit', $user)
//        ->set('user.iva_certificate', true)
//        ->set('iva_certificate_file', $file)
//        ->call('update')
//        ->assertHasErrors('iva_certificate_file');
//});
