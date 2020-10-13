<div>
    @if ($event)
        <x-jet-confirmation-modal wire:model="active">
            <x-slot name="title">
                {{ __('Delete') }} {{ $event->name }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you would like to delete') }} {{ $event->name }}?
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('active')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    @endif
</div>
