<div>
    @livewire('events.create-event-form')

    <x-jet-section-border />

    <!-- Manage Users -->
    <div class="mt-10 sm:mt-0">
        <x-jet-action-section>
            <x-slot name="title">
                {{ __('Manage Events') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Edit a bartender to update, for example, their IVA certificate or bartending course status.') }}
            </x-slot>

            <!-- Users List -->
            <x-slot name="content">
                <div class="space-y-6">
                    @foreach ($this->events->sortBy('starts_at') as $event)
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline">
                                <div class="pr-4 text-right text-gray-600 w-36">
                                    {{ $event->starts_at->format('D d-m H:i') }}
                                </div>

                                {{ $event->name }}

                                <div class="ml-2 text-sm text-gray-400">
                                    {{ __(
                                        ':shifts barshifts that require :bartenders bartenders',
                                        ['shifts' => $event->shifts->count(), 'bartenders' => $event->shifts->sum('bartenders')]
                                    ) }}
                                </div>
                            </div>

                            <div class="flex items-center">
                                <button class="cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none" wire:click="editShifts({{ $event->id }})">
                                    {{ __('Edit Shifts') }}
                                </button>

                                <button class="cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none" wire:click="edit({{ $event->id }})">
                                    {{ __('Edit Event') }}
                                </button>

                                <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="delete({{ $event->id }})">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-slot>
        </x-jet-action-section>
    </div>

    @livewire('events.edit-event-modal')

    @livewire('events.edit-shifts-modal')

    @livewire('events.delete-event-modal')
</div>
