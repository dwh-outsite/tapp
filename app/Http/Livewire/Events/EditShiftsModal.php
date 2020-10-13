<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use App\Models\EventShift;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditShiftsModal extends Component
{
    use WithFileUploads;

    public $active = false;
    public ?Event $event = null;

    public $new = [
        'start_time' => '',
        'bartenders' => EventShift::DEFAULT_NUMBER_OF_BARTENDERS,
    ];

    public ?EventShift $editingEventShift = null;

    protected $listeners = [
        'edit-shifts' => 'handleEditShifts'
    ];

    protected $rules = [
        'editingEventShift.start_time' => ['required', 'string', 'max:255'],
        'editingEventShift.bartenders' => ['required', 'integer', 'min:0'],
    ];

    public function handleEditShifts(Event $event)
    {
        $this->active = true;
        $this->event = $event;
    }

    public function add()
    {
        $this->event->shifts()->create($this->validate([
            'new.start_time' => ['required', 'string', 'max:255'],
            'new.bartenders' => ['required', 'integer', 'min:0'],
        ])['new']);

        $this->reset('new');
        $this->clearValidation('new');
    }

    public function edit(EventShift $shift)
    {
        $this->editingEventShift = $shift;
    }

    public function update()
    {
        $this->editingEventShift->save();

        $this->editingEventShift = null;

        $this->clearValidation('editingEventShift');
    }

    public function remove(EventShift $shift)
    {
        $shift->delete();
    }

    public function render()
    {
        if ($this->event) {
            $this->event->refresh();
        }

        return view('events.edit-shifts-modal');
    }
}
