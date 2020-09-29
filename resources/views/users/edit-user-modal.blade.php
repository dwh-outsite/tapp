<div>
    @if ($user)
        <x-jet-dialog-modal wire:model="active">

            <x-slot name="title">
                {{ __('Edit') }} {{ $user->name }}
            </x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="user.name" autofocus />
                        <x-jet-input-error for="user.name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="user.email" autofocus />
                        <x-jet-input-error for="user.email" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label class="flex items-center mb-2">
                            <input type="checkbox" class="form-checkbox" wire:model="user.bartending_course">
                            <span class="ml-2 text-sm text-gray-600">Completed Bartending Course</span>
                        </label>

                        @if ($user->bartending_course)
                            <x-jet-label for="bartending_course_date" value="{{ __('Bartending Course Date (optional)') }}" />
                            <x-jet-input id="bartending_course_date" type="date" class="mt-1 block w-full" wire:model.defer="user.bartending_course_date" autofocus />
                            <x-jet-input-error for="user.bartending_course_date" class="mt-2" />
                        @endif
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label class="flex items-center mb-2">
                            <input type="checkbox" class="form-checkbox" wire:model="user.iva_certificate">
                            <span class="ml-2 text-sm text-gray-600">IVA Certificate</span>
                        </label>

                        @if ($user->iva_certificate)
                            <x-jet-label for="iva_certificate_file" value="{{ __('Upload IVA Certificate') }}" />
                            <x-jet-input id="iva_certificate_file" type="file" class="mt-1 block w-full" wire:model.defer="iva_certificate_file" autofocus />
                            <x-jet-input-error for="iva_certificate_file" class="mt-2" />
                        @endif
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
