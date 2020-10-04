<?php

use App\Http\Livewire\Bartenders\EditBartenderModal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Livewire\livewire;

it("can update a bartender's name", function () {
    $user = User::factory()->state(['name' => 'Henk'])->create();

    livewire(EditBartenderModal::class)
        ->emit('edit', $user)
        ->set('user.name', 'Astrid')
        ->call('update');

    $user->refresh();
    expect($user->name)->toBe('Astrid');
});

it("can update a bartender's email", function () {
    $user = User::factory()->state(['email' => 'hans@h-mail.com'])->create();

    livewire(EditBartenderModal::class)
        ->emit('edit', $user)
        ->set('user.email', 'anne@h-mail.com')
        ->call('update');

    $user->refresh();
    expect($user->email)->toBe('anne@h-mail.com');
});

it("can update a bartender's bartending course status", function () {
    $user = User::factory()->state(['bartending_course' => false])->create();

    livewire(EditBartenderModal::class)
        ->emit('edit', $user)
        ->set('user.bartending_course', true)
        ->set('user.bartending_course_date', $courseDate = Carbon::parse('1 January 2000'))
        ->call('update');

    $user->refresh();
    expect($user->bartending_course)->toBeTrue();
    expect($user->bartending_course_date->equalTo($courseDate))->toBeTrue();
});

it("can update a bartender's iva certificate status", function () {
    $user = User::factory()->state(['iva_certificate' => false])->create();

    livewire(EditBartenderModal::class)
        ->emit('edit', $user)
        ->set('user.iva_certificate', true)
        ->call('update');

    $user->refresh();
    expect($user->iva_certificate)->toBeTrue();
});

it("can update a bartender's iva certificate", function () {
    Storage::fake();

    $file = UploadedFile::fake()->create('certificate.pdf');

    $user = User::factory()->state(['iva_certificate' => false])->create();

    livewire(EditBartenderModal::class)
        ->emit('edit', $user)
        ->set('user.iva_certificate', true)
        ->set('iva_certificate_file', $file)
        ->call('update');

    $user->refresh();
    expect($user->iva_certificate)->toBeTrue();
    expect(Storage::disk('tmp-for-tests')->exists($user->iva_certificate_file))->toBeTrue();
});

it("cannot update a bartender's iva certificate to be a non-pdf", function () {
    Storage::fake();

    $file = UploadedFile::fake()->create('certificate.exe');

    $user = User::factory()->state(['iva_certificate' => false])->create();

    livewire(EditBartenderModal::class)
        ->emit('edit', $user)
        ->set('user.iva_certificate', true)
        ->set('iva_certificate_file', $file)
        ->call('update')
        ->assertHasErrors('iva_certificate_file');
});
