<div>
    <!-- Generate API Token -->
    @livewire('users.create-user-form')

    <x-jet-section-border />

    <!-- Manage Users -->
    <div class="mt-10 sm:mt-0">
        <x-jet-action-section>
            <x-slot name="title">
                {{ __('Manage Bartenders') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Edit a bartender to update, for example, their IVA certificate or bar course status.') }}
            </x-slot>

            <!-- Users List -->
            <x-slot name="content">
                <div class="space-y-6">
                    @foreach ($this->users->sortBy('name') as $user)
                        <div class="flex items-center justify-between">
                            <div>
                                {{ $user->name }}
                            </div>

                            <div class="flex items-center">
                                <div class="text-sm text-gray-400">
                                    {{ __('Created') }} {{ $user->created_at->diffForHumans() }}
                                </div>

                                <button class="cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none" wire:click="edit({{ $user->id }})">
                                    {{ __('Edit') }}
                                </button>

                                <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="delete({{ $user->id }})">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-slot>
        </x-jet-action-section>
    </div>

    @livewire('users.edit-user-modal')

    @livewire('users.delete-user-modal')
</div>
