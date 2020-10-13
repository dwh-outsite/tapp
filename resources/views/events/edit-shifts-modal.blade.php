<div>
    @if ($event)
        <x-jet-dialog-modal wire:model="active">

            <x-slot name="title">
                {{ __('Edit Shifts of') }} {{ $event->name }}
            </x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6">
                        @foreach ($event->shifts as $index => $shift)
                            <div class="flex items-center justify-between bg-gray-50 py-2 px-4 rounded-lg mb-2">
                                <div class="uppercase text-gray-700 text-sm tracking-wide w-32">
                                    Shift {{ $index + 1 }}
                                </div>
                                <div class="mr-4">
                                    @if (optional($editingEventShift)->is($shift))
                                        <x-jet-input id="editingEventShift.start_time" type="text" class="w-28" placeholder="{{ __('Start Time') }}" wire:model.defer="editingEventShift.start_time" autofocus />
                                        <x-jet-input-error for="editingEventShift.start_time" class="mt-2" />
                                    @else
                                        <span class="text-gray-700 text-sm">Starts at</span>
                                        {{ $shift->start_time }}
                                    @endif
                                </div>
                                <div>
                                    @if (optional($editingEventShift)->is($shift))
                                        <x-jet-input id="editingEventShift.bartenders" type="text" class="w-10 text-center" placeholder="{{ __('Bartenders') }}" wire:model.defer="editingEventShift.bartenders" autofocus />
                                        <span class="text-gray-700 text-sm">bartenders</span>
                                        <x-jet-input-error for="editingEventShift.bartenders" class="mt-2" />
                                    @else
                                        {{ $shift->bartenders }} <span class="text-gray-700 text-sm">bartenders</span>
                                    @endif
                                </div>
                                <div>
                                    @if (optional($editingEventShift)->is($shift))
                                        <span wire:click="update" class="ml-2 bg-gray-800 py-1 px-2 text-xs uppercase text-white cursor-pointer rounded-full">Save</span>
                                    @else
                                        <span wire:click="edit({{ $shift->id }})" class="ml-2 border border-gray-700 py-1 px-2 text-xs uppercase text-gray-700 cursor-pointer rounded-full">Edit</span>
                                    @endif
                                    <span wire:click="remove({{ $shift->id }})" class="ml-2 py-1 px-2 text-xs uppercase text-gray-700 cursor-pointer rounded-full">Remove</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex items-center justify-between bg-gray-50 py-2 px-4 rounded-lg mt-4">
                            <div class="uppercase text-gray-700 text-sm tracking-wide w-32">
                                New Shift
                            </div>
                            <div class="mr-4">
                                <x-jet-input id="new.start_time" type="text" class="w-28" placeholder="{{ __('Start Time') }}" wire:model.defer="new.start_time" autofocus />
                                <x-jet-input-error for="new.start_time" class="mt-2" />
                            </div>
                            <div>
                                <x-jet-input id="newbartenders" type="text" class="w-10 text-center" placeholder="{{ __('Bartenders') }}" wire:model.defer="new.bartenders" autofocus />
                                <span class="text-gray-700 text-sm">bartenders</span>
                                <x-jet-input-error for="new.bartenders" class="mt-2" />
                            </div>
                            <div>
                                <span wire:click="add" class="ml-2 bg-gray-400 py-1 px-2 text-xs uppercase text-white cursor-pointer rounded-full">Add</span>
                            </div>
                        </div>
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('active')" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>
