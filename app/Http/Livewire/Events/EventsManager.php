<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Livewire\Component;

class EventsManager extends Component
{
    protected $listeners = [
        'created' => '$refresh',
        'updated' => '$refresh',
        'deleted' => '$refresh',
    ];

    public function edit(Event $event)
    {
        $this->emit('edit', $event);
    }

    public function editShifts(Event $event)
    {
        $this->emit('edit-shifts', $event);
    }

    public function delete(Event $event)
    {
        $this->emit('delete', $event);
    }

    public function getEventsProperty()
    {
        return Event::all();
    }

    public function render()
    {
        return view('events.events-manager');
    }
}
