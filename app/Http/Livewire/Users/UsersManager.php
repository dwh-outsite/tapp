<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class UsersManager extends Component
{
    public $managingPermissionsFor;

    public $confirmingApiTokenDeletion = false;
    public $apiTokenIdBeingDeleted;

    protected $listeners = [
        'created' => '$refresh',
        'updated' => '$refresh',
        'deleted' => '$refresh',
    ];

    public function edit(User $user)
    {
        $this->emit('edit', $user);
    }

    public function delete(User $user)
    {
        $this->emit('delete', $user);
    }

    public function confirmApiTokenDeletion($tokenId)
    {
        $this->confirmingApiTokenDeletion = true;

        $this->apiTokenIdBeingDeleted = $tokenId;
    }

    /**
     * Delete the API token.
     *
     * @return void
     */
    public function deleteApiToken()
    {
        $this->user->tokens()->where('id', $this->apiTokenIdBeingDeleted)->delete();

        $this->user->load('tokens');

        $this->confirmingApiTokenDeletion = false;

        $this->managingPermissionsFor = null;
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUsersProperty()
    {
        return User::all();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('users.users-manager');
    }
}
