<div>
    @livewire('bartenders.create-bartender-form')

    <x-jet-section-border />

    <!-- Manage Users -->
    <div class="mt-10 sm:mt-0">
        <x-jet-action-section>
            <x-slot name="title">
                {{ __('Manage Bartenders') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Edit a bartender to update, for example, their IVA certificate or bartending course status.') }}
            </x-slot>

            <!-- Users List -->
            <x-slot name="content">
                <div class="space-y-6">
                    @foreach ($this->users->sortBy('name') as $user)
                        <div class="flex items-center justify-between">
                            <div>
                                <img class="h-8 w-8 rounded-full object-cover inline mr-2" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />

                                {{ $user->name }}


                                @if ($user->iva_certificate)
                                    <span
                                        class="ml-2 bg-green-400 py-1 px-2 rounded text-xs uppercase tracking-wider font-bold text-white inline-flex items-center @if ($user->iva_certificate_file) cursor-pointer @endif"
                                        wire:click="downloadIvaCertificate({{ $user->id }})"
                                    >
                                        IVA
                                        @if ($user->iva_certificate_file)
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
                                        @endif
                                    </span>
                                @endif
                                @if ($user->bartending_course)
                                    <span class="bg-blue-400 py-1 px-2 rounded text-xs uppercase tracking-wider font-bold text-white">
                                        BC
                                        @if ($user->bartending_course_date)
                                            <span class="font-normal tracking-normal normal-case">
                                                {{ $user->bartending_course_date->diffForHumans() }}
                                            </span>
                                        @endif
                                    </span>
                                @endif
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

    @livewire('bartenders.edit-bartender-modal')

    @livewire('bartenders.delete-bartender-modal')
</div>
