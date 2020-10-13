<div>
    @if ($event)
        <x-jet-dialog-modal wire:model="active">

            <x-slot name="title">
                {{ __('Edit') }} {{ $event->name }}
            </x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" placeholder="{{ __('The name of the event') }}" wire:model.defer="event.name" autofocus />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="starts_at" value="{{ __('Starts At') }}" />
                        <x-jet-input id="starts_at" type="datetime-local" class="mt-1 block w-full" placeholder="{{ __('The start time of the event') }}" wire:model="event.starts_at" autofocus />
                        <x-jet-input-error for="starts_at" class="mt-2" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('active')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>
