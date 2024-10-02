<div class="container">


<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

<h1 class="h3 mb-3"><strong>Manage Space Stations</strong></h1>

<div class="mt-8 text-2xl">
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
        <div class="mb-2"> <!-- Search Box -->
            <input wire:model.live.debounce.500ms="q" type="text" class="ms-3 px-4 py-2 border rounded" style="width: 100vh;" placeholder="Search...">
        </div>

            <div class="text-right"> <!-- Create Button -->
                <button style="border:1.7px solid black" wire:click="confirmSpaceStationAdd" class="px-4 py-2 rounded">Create</button>
            </div>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr style="text-align:center;">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Space Station Name</th>
                    <th class="px-4 py-2">Space Station Planet</th>
                    <th class="px-4 py-2">Distance from Earth</th>
                    <th class="px-4 py-2">Time at Space Station</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($spacestations as $spacestation)
                <tr style="text-align:center;">
                    <td class="border px-4 py-2">{{ $spacestation->id }}</td>
                    <td class="border px-4 py-2">{{ $spacestation->spacestation_name }} </td>
                    <td class="border px-4 py-2">{{ $spacestation->spacestation_location }} </td>
                    <td class="border px-4 py-2">{{ $spacestation->distance_from_earth }} </td>
                    <td class="border px-4 py-2">{{ $spacestation->time_at_space_station }}-days-earlier </td>
                    <td class="border px-4 py-2">
                        <div wire:key="customer-{{ $spacestation->id }}">
                            <x-button wire:key="edit-button-{{ $spacestation->id }}" wire:click="editSpaceStation({{ $spacestation->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                                Edit    
                            </x-button>
                            <x-danger-button wire:key="delete-button-{{ $spacestation->id }}" wire:click="confirmSpaceStationDelete({{ $spacestation->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                                Delete
                            </x-danger-button>
                        </div>
</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $spacestations->links() }} <!-- Pagination Links -->                 


    <!-- Delete Space Station Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingSpaceStationDeletion">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Space Station?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingSpaceStationDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteSpaceStation({{ $confirmingSpaceStationDeletion }})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal> 
    
    
<!-- Add New Space Station -->
<x-dialog-modal wire:model.defer="confirmingSpaceStationAdd">
    <x-slot name="title">
        {{ $isEditMode ? 'Edit Space Station' : 'Add Space Station' }}
    </x-slot>

    <x-slot name="content">
        <!-- Spacestation name -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="spacestation_name" value="{{ __('Space Station Name') }}" />
            <x-input id="spacestation_name" type="text" class="mt-1 block w-full" wire:model.defer="spacestation.spacestation_name" required />
            <x-input-error for="spacestation.spacestation_name" class="mt-2" />   
        </div>
        <!-- spacestation_location -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="spacestation_location" value="{{ __('Space Station Planet') }}" />
            <x-input id="spacestation_location" type="text" class="mt-1 block w-full" wire:model.defer="spacestation.spacestation_location" required />
            <x-input-error for="spacestation.spacestation_location" class="mt-2" />
        </div>

        <!-- distance_from_earth -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="distance_from_earth" value="{{ __('Distance from Earth') }}" />
            <x-input id="distance_from_earth" type="number" class="mt-1 block w-full" wire:model.defer="spacestation.distance_from_earth" required />
            <x-input-error for="spacestation.distance_from_earth" class="mt-2" />
        </div>

        <!-- time_at_space_station -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="time_at_space_station" value="{{ __('Time in Space Station') }}" />
            <x-input id="time_at_space_station" type="number" class="mt-1 block w-full" wire:model.defer="spacestation.time_at_space_station" required />
            <x-input-error for="spacestation.time_at_space_station" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmingSpaceStationAdd', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="addSpaceStation" wire:loading.attr="disabled">
            {{ __('Save Customer') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>



</div>
</div>
