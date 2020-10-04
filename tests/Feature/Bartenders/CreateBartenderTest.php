<?php

use App\Http\Livewire\Bartenders\CreateBartenderForm;
use App\Mail\BartenderCreated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use function Pest\Livewire\livewire;

it('can create a bartender', function () {
    livewire(CreateBartenderForm::class)
        ->set('name', 'Henk')
        ->set('email', 'henk@h-mail.com')
        ->call('create');

    $user = User::firstOrFail();
    expect($user->name)->toBe('Henk');
    expect($user->email)->toBe('henk@h-mail.com');
});

it('can generate a unique password hash for new bartenders', function () {
    livewire(CreateBartenderForm::class)
        ->set('name', 'Henk')
        ->set('email', 'henk@h-mail.com')
        ->call('create');

    livewire(CreateBartenderForm::class)
        ->set('name', 'Astrid')
        ->set('email', 'astrid@h-mail.com')
        ->call('create');

    $userA = User::whereName('Henk')->firstOrFail();
    $userB = User::whereName('Astrid')->firstOrFail();
    expect($userA->password)->not->toBe($userB->password);
});

it('can notify a new bartender that their account is created', function () {
    Mail::fake();

    livewire(CreateBartenderForm::class)
        ->set('name', 'Henk')
        ->set('email', 'henk@h-mail.com')
        ->call('create');

    $user = User::firstOrFail();

    Mail::assertSent(function (BartenderCreated $mail) {
        return $mail->hasTo('henk@h-mail.com');
    });
});

it('cannot create a bartender without a name')
    ->livewire(CreateBartenderForm::class)
    ->set('email', 'henk@h-mail.com')
    ->call('create')
    ->assertHasErrors('name');

it('cannot create a bartender without an email address')
    ->livewire(CreateBartenderForm::class)
    ->set('name', 'Henk')
    ->call('create')
    ->assertHasErrors('email');

it('cannot create a bartender with an invalid email')
    ->livewire(CreateBartenderForm::class)
    ->set('name', 'Henk')
    ->set('email', 'henk-mail')
    ->call('create')
    ->assertHasErrors('email');

it('cannot create a bartender with an duplicate email', function () {
    livewire(CreateBartenderForm::class)
        ->set('name', 'Henk')
        ->set('email', 'henk@h-mail.com')
        ->call('create');

    expect(User::exists())->toBeTrue();

    livewire(CreateBartenderForm::class)
        ->set('name', 'Astrid')
        ->set('email', 'henk@h-mail.com')
        ->call('create')
        ->assertHasErrors('email');
});
