<x-jet-form-section submit="create">
    <x-slot name="title">
        {{ __('Create Event') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create a new event with its corresponding bar shifts. Starting times for bar shifts are suggested automatically after the starting date of the event has been selected.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" placeholder="{{ __('The name of the event') }}" wire:model.defer="name" autofocus />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="starts_at" value="{{ __('Starts At') }}" />
            <x-jet-input id="starts_at" type="datetime-local" class="mt-1 block w-full" placeholder="{{ __('The start time of the event') }}" wire:model="starts_at" />
            <x-jet-input-error for="starts_at" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <div class="flex items-baseline justify-between mb-1">
                <x-jet-label value="{{ __('Shifts') }}" />
                <span wire:click="addShift" class="ml-2 mr-4 bg-gray-400 py-1 px-2 text-xs uppercase text-white cursor-pointer rounded-full">Add</span>
            </div>
            @foreach ($shifts as $index => $shift)
                <div class="flex items-center justify-between bg-gray-50 py-2 px-4 rounded-lg mb-2">
                    <div class="uppercase text-gray-700 text-sm tracking-wide w-32">
                        Shift {{ $index + 1 }}
                    </div>
                    <div class="mr-4">
                        <x-jet-input id="shifts.{{ $index }}.start_time" type="text" class="w-28" placeholder="{{ __('Start Time') }}" wire:model.defer="shifts.{{ $index }}.start_time" />
                        <x-jet-input-error for="shifts.{{ $index }}.start_time" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-input id="shifts.{{ $index }}.bartenders" type="text" class="w-10 text-center" placeholder="{{ __('Bartenders') }}" wire:model.defer="shifts.{{ $index }}.bartenders" />
                        <span class="text-gray-700 text-sm">bartenders</span>
                        <x-jet-input-error for="shifts.{{ $index }}.bartenders" class="mt-2" />
                    </div>
                    <div>
                        <span wire:click="removeShift({{ $index }})" class="ml-2 border border-gray-700 py-1 px-2 text-xs uppercase text-gray-700 cursor-pointer rounded-full">Remove</span>
                    </div>
                </div>
            @endforeach
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="created">
            {{ __('Created.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Create') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
