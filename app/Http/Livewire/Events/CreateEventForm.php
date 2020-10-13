<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use App\Models\EventShift;
use Carbon\Carbon;
use Livewire\Component;

class CreateEventForm extends Component
{
    public $name;
    public $starts_at;
    public $shifts = [
        ['start_time' => '', 'bartenders' => EventShift::DEFAULT_NUMBER_OF_BARTENDERS]
    ];

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'starts_at' => ['required', 'date'],
        'shifts' => ['required', 'array', 'min:1'],
        'shifts.*.start_time' => ['required', 'string', 'max:255'],
        'shifts.*.bartenders' => ['required', 'integer', 'min:0'],
    ];

    public function addShift()
    {
        $this->shifts[] = [
            'start_time' => $this->computeShiftStartTimeSuggestion(count($this->shifts)),
            'bartenders' => EventShift::DEFAULT_NUMBER_OF_BARTENDERS
        ];
    }

    public function removeShift($index)
    {
        unset($this->shifts[$index]);

        $this->shifts = array_values($this->shifts);
    }

    public function updatedStartsAt()
    {
        if (empty ($this->shifts)) {
            return;
        }

        $this->shifts = collect($this->shifts)->map(function ($shift, $index) {
            $shift['start_time'] = $this->computeShiftStartTimeSuggestion($index);

            return $shift;
        })->all();
    }

    protected function computeShiftStartTimeSuggestion($index) {
        if (!$this->starts_at) {
            return '';
        }

        return Carbon::parse($this->starts_at)->addHours(2 * $index)->format('H:i');
    }

    public function create()
    {
        $this->validate();

        $event = Event::create(['name' => $this->name, 'starts_at' => $this->starts_at]);

        collect($this->shifts)->each(fn($shift) => $event->shifts()->create($shift));

        $this->reset();
        $this->resetValidation();

        $this->emit('created');
    }

    public function render()
    {
        return view('events.create-event-form');
    }
}
