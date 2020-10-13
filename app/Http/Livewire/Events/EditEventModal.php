<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditEventModal extends Component
{
    use WithFileUploads;

    public $active = false;
    public ?Event $event = null;

    protected $listeners = [
        'edit' => 'handleEdit'
    ];

    protected $rules = [
        'event.name' => ['required', 'string', 'max:255'],
        'event.starts_at' => ['required', 'date'],
    ];

    public function handleEdit(Event $event)
    {
        $this->active = true;
        $this->event = $event;
    }

    public function update()
    {
        $this->validate();

        $this->event->save();

        $this->clearValidation();
        $this->reset();

        $this->emit('updated');
    }

    public function render()
    {
        return view('events.edit-event-modal');
    }
}
