<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Livewire\Component;

class DeleteEventModal extends Component
{
    public $active = false;
    public ?Event $event = null;

    protected $listeners = [
        'delete' => 'handleDelete'
    ];

    public function handleDelete(Event $event)
    {
        $this->active = true;
        $this->event = $event;
    }

    public function delete()
    {
        $this->event->delete();

        $this->reset();

        $this->emit('deleted');
    }

    public function render()
    {
        return view('events.delete-event-modal');
    }
}
