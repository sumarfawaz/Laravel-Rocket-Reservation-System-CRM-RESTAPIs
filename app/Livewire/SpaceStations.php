<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SpaceStation;
use Livewire\WithPagination;


class SpaceStations extends Component
{
    use WithPagination;
    public $q;
    public $spacestation = [];

    public $confirmingSpaceStationDeletion = false;
    public $confirmingSpaceStationAdd = false;

    public $isEditMode = false;

    public function UpdatingQ()
    {
        $this->resetPage();
    }

    public function getRules()
    {
        if (isset($this->spacestation['id'])) {
            return [
                'spacestation.spacestation_name' => 'string|unique:space_stations,spacestation_name,' . $this->spacestation['id'] . '|max:255',
                'spacestation.spacestation_location' => 'string',
                'spacestation.distance_from_earth' => 'integer',
                'spacestation.time_at_space_station' => 'integer',
            ];
        }

        return [
            'spacestation.spacestation_name' => 'required|string|unique:space_stations,spacestation_name|max:255',
            'spacestation.spacestation_location' => 'required|string',
            'spacestation.distance_from_earth' => 'integer',
            'spacestation.time_at_space_station' => 'required|integer',
        ];
    }

    public function render()
    {
        $spacestations = SpaceStation::query()
        ->when($this->q, function($query) {
            return $query->where('spacestation_name', 'like', '%'.$this->q.'%')
            ->orWhere('spacestation_location', 'like', '%'.$this->q.'%')
            ->orWhere('distance_from_earth', 'like', '%'.$this->q.'%')
            ->orWhere('time_at_space_station', 'like', '%'.$this->q.'%');
        })
        ->paginate(10);

        return view('livewire.space-stations'
        , ['spacestations' => $spacestations]);
    }

    public function confirmSpaceStationDelete($spacestationId)
    {
        $this->confirmingSpaceStationDeletion = $spacestationId;
    }

    public function deleteSpaceStation(SpaceStation $spacestation)
    {
        $spacestation->delete();
        $this->confirmingSpaceStationDeletion = false;
    }

    public function confirmSpaceStationAdd()
    {
        $this->isEditMode = false;
        $this->confirmingSpaceStationAdd = true;
        $this->spacestation = [];
    }

    public function editSpaceStation($spacestationId)
    {
        $spacestation = SpaceStation::find($spacestationId);

        if ($spacestation) {
            $this->isEditMode = true;
            $this->confirmingSpaceStationAdd = true;
            $this->spacestation = $spacestation->toArray();
        }else {
            session()->flash('error', 'Space Station not found.');
        }
    }

    public function addSpaceStation()
    {
        $this->validate($this->getRules());

        if (isset($this->spacestation['id'])) {
            $spacestation = SpaceStation::find($this->spacestation['id']);
            $spacestation->update($this->spacestation);
            \Log::info('Updating Space Station: ' . $this->spacestation['spacestation_name']);
            $this->confirmingSpaceStationAdd = false;
            $this->spacestation = [];

        } else {
            try {
                SpaceStation::create([
                    'spacestation_name' => $this->spacestation['spacestation_name'],
                    'spacestation_location' => $this->spacestation['spacestation_location'],
                    'distance_from_earth' => $this->spacestation['distance_from_earth'],
                    'time_at_space_station' => $this->spacestation['time_at_space_station'],
                ]);
                \Log::info('Creating Space Station: ' . $this->spacestation['spacestation_name']);
                $this->confirmingSpaceStationAdd = false;
                $this->spacestation = [];
            
            } catch (\Illuminate\Validation\ValidationException $e) {
                \Log::error('Validation failed: ' . json_encode($e->errors()));
                session()->flash('error', 'Validation failed: Please check your inputs.');
            } catch (\Exception $e) {
                \Log::error('Error saving spacestation: ' . $e->getMessage());
                session()->flash('error', 'An error occurred while saving the space station. Please try again.');
            }
        }

        $this->isEditMode = false; // Reset edit mode
        $this->confirmingSpaceStationAdd = false;
        $this->spacestation = [];
    }

}
