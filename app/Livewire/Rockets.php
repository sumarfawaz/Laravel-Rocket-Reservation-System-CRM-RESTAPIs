<?php

namespace App\Livewire;
use App\Models\Rocket;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Schema;

class Rockets extends Component
{
    use WithPagination;

    public $q; // Property to store search input
    public $rocket = []; // Property to store rocket data      
    
    public $confirmingRocketDeletion = false;
    public $confirmingRocketAdd = false;

    public $isEditMode = false; // Property to track if we're editing or creating



    public function UpdatingQ()
    {
        $this->resetPage(); // Resets to the first page whenever the search term is updated
    }


    public function getRules()
    {
        // Check if we are updating an existing rocket
        if (isset($this->rocket['id'])) {
            return [
                'rocket.rocketname' => 'string|unique:rockets,rocketname,' . $this->rocket['id'] . '|max:255', // Ensure the rocketname is unique except for the current rocket
                'rocket.height' => 'sometimes|integer|max:255',
                'rocket.diameter' => 'sometimes|integer|max:255',
                'rocket.mass' => 'sometimes|integer|max:255',
                'rocket.payloadtoleo' => 'sometimes|integer|max:255',
                'rocket.payloadtogto' => 'sometimes|integer|max:255',
                'rocket.payloadtomars' => 'sometimes|integer|max:255',
            ];
        }

        // Return rules for creating a rocket
        return [
            'rocket.rocketname' => 'required|string|unique:rockets,rocketname|max:255',
            'rocket.height' => 'required|integer|max:255',
            'rocket.diameter' => 'required|integer|max:255',
            'rocket.mass' => 'required|integer|max:255',
            'rocket.payloadtoleo' => 'required|integer|max:255',
            'rocket.payloadtogto' => 'required|integer|max:255',
            'rocket.payloadtomars' => 'required|integer|max:255',
        ];
    }

    public function render()
    {
        $rockets = Rocket::query()
        ->when($this->q, function($query) {
            return $query->where('rocketname', 'like', '%'.$this->q.'%')
            ->orWhere('height', 'like', '%'.$this->q.'%')
            ->orWhere('diameter', 'like', '%'.$this->q.'%')
            ->orWhere('mass', 'like', '%'.$this->q.'%')
            ->orWhere('payloadtoleo', 'like', '%'.$this->q.'%')
            ->orWhere('payloadtogto', 'like', '%'.$this->q.'%')
            ->orWhere('payloadtomars', 'like', '%'.$this->q.'%');
        })
        ->paginate(10);

        
        return view('livewire.rockets',
            [
                'rockets' => $rockets
            ]
        );  
    }


    public function confirmRocketDelete($rocketId)
    {
        $this->confirmingRocketDeletion = $rocketId;
    }

    public function deleteRocket(Rocket $rocket)
    {
        $rocket->delete();
        $this->confirmingRocketDeletion = false;
    }

    public function confirmRocketAdd()
    {
        $this->rocket = [];
        $this->isEditMode = false; // Set to create mode
        $this->confirmingRocketAdd = true;
    }

    public function confirmRocketEdit($rocketId)
    {
         // Fetch the customer from the database
         $rocket = Rocket::find($rocketId);

         // Check if the customer exists
         if ($rocket) {
             // Populate the $this->customer property with the customer's data
             $this->rocket = $rocket->toArray(); // Convert to array if needed for form binding
             $this->isEditMode = true;
             // Open the modal for editing
             $this->confirmingRocketAdd = true; // Change to true to show the modal
         } else {
             // Optionally handle the case where the customer doesn't exist
             session()->flash('error', 'Customer not found.');
         }
    }

    public function saveRocket()
    {
        \Log::info('saveRocket Method Triggered');

        $this->validate($this->getRules());

        if (isset($this->rocket['id'])) {
            $rocket = Rocket::find($this->rocket['id']);
            $rocket->update($this->rocket);
            \Log::info('Rocket Updated');
            $this->confirmingRocketAdd = false;
            $this->rocket = [];
        }else{
            try {
                Rocket::create([
                    'rocketname' => $this->rocket['rocketname'],
                    'height' => $this->rocket['height'],
                    'diameter' => $this->rocket['diameter'],
                    'mass' => $this->rocket['mass'],
                    'payloadtoleo' => $this->rocket['payloadtoleo'],
                    'payloadtogto' => $this->rocket['payloadtogto'],
                    'payloadtomars' => $this->rocket['payloadtomars']
                ]);
                session()->flash('success', 'Customer created successfully.');
                \Log::info('Customer created successfully.');
                $this->confirmingRocketAdd = false;
                $this->rocket = [];

            } catch (\Illuminate\Validation\ValidationException $e) {
                \Log::error('Validation failed: ' . json_encode($e->errors()));
                session()->flash('error', 'Validation failed: Please check your inputs.');
            } catch (\Exception $e) {
                \Log::error('Error saving rocket: ' . $e->getMessage());
                session()->flash('error', 'An error occurred while saving the rocket. Please try again.');
            }
        }
        $this->isEditMode = false; // Reset edit mode
        $this->confirmingRocketAdd = false;
         $this->rocket = [];
        
    }
}
