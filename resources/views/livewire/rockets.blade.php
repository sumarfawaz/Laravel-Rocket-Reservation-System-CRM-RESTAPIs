<div class="container">


<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

<h1 class="h3 mb-3"><strong>Manage Rockets</strong></h1>

    <div class="mt-6">
        <div class="flex justify-between">
        <div class="mb-2"> <!-- Search Box -->
            <input wire:model.live.debounce.500ms="q" type="text" class="ms-3 px-4 py-2 border rounded" style="width: 100vh;" placeholder="Search...">
        </div>

            <div class="text-right"> <!-- Create Button -->
                <button style="border:1.7px solid black" wire:click="confirmRocketAdd" class="px-4 py-2 rounded">Create</button>
            </div>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr style="text-align:center;">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Rocket Name</th>
                    <th class="px-4 py-2">Height</th>
                    <th class="px-4 py-2">Diameter</th>
                    <th class="px-4 py-2">Mass</th>
                    <th class="px-4 py-2">Payload to Leo</th>
                    <th class="px-4 py-2">Payload to GTO</th>
                    <th class="px-4 py-2">Payload to Mars</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rockets as $rocket)
                <tr style="text-align:center;">
                    <td class="border px-4 py-2">{{ $rocket->id }}</td>
                    <td class="border px-4 py-2">{{ $rocket->rocketname }} </td>
                    <td class="border px-4 py-2">{{ $rocket->height }} meters</td>
                    <td class="border px-4 py-2">{{ $rocket->diameter }} </td>
                    <td class="border px-4 py-2">{{ $rocket->mass }} lb</td>
                    <td class="border px-4 py-2">{{ $rocket->payloadtoleo }} lb</td>
                    <td class="border px-4 py-2">{{ $rocket->payloadtogto }} lb</td>
                    <td class="border px-4 py-2">{{ $rocket->payloadtomars }} lb</td>
                    <td class="border px-4 py-2">
                        <div wire:key="customer-{{ $rocket->id }}">
                            <x-button wire:key="edit-button-{{ $rocket->id }}" wire:click="confirmRocketEdit({{ $rocket->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                                Edit    
                            </x-button>
                            <x-danger-button wire:key="delete-button-{{ $rocket->id }}" wire:click="confirmRocketDelete({{ $rocket->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-50">
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
        {{ $rockets->links() }} <!-- Pagination Links -->
    </div>

    <!-- Delete Space Station Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingRocketDeletion">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Rocket?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingRocketDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteRocket({{ $confirmingRocketDeletion }})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>


    <!-- Add New Rocket -->
<x-dialog-modal wire:model.defer="confirmingRocketAdd">
    <x-slot name="title">
    {{ $isEditMode ? 'Edit Rocket' : 'Add Rocket' }}
    </x-slot>

    <x-slot name="content">
        <!-- rocketname -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="rocketname" value="{{ __('Rocket Name') }}" />
            <x-input id="rocketname" type="text" class="mt-1 block w-full" wire:model.live="rocket.rocketname" required />
            <x-input-error for="rocket.rocketname" class="mt-2" />   
        </div>
        <!-- Height -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="height" value="{{ __('Height') }}" />
            <x-input id="height" type="number" class="mt-1 block w-full" wire:model.live="rocket.height" required />
            <x-input-error for="rocket.height" class="mt-2" />
        </div>

        <!-- Diameter -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="diameter" value="{{ __('Diameter') }}" />
            <x-input id="diameter" type="number" class="mt-1 block w-full" wire:model.live="rocket.diameter" required />
            <x-input-error for="rocket.diameter" class="mt-2" />
        </div>

        <!-- Mass -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="mass" value="{{ __('Mass') }}" />
            <x-input id="mass" type="number" class="mt-1 block w-full" wire:model.live="rocket.mass" required />
            <x-input-error for="rocket.mass" class="mt-2" />
        </div>

        <!-- payloadtoleo -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="payloadtoleo" value="{{ __('Payload to Leo') }}" />
            <x-input id="payloadtoleo" type="number" class="mt-1 block w-full" wire:model.live="rocket.payloadtoleo" required />
            <x-input-error for="rocket.payloadtoleo" class="mt-2" />
        </div>

        <!-- payloadtogto -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="payloadtogto" value="{{ __('Payload to GTO') }}" />
            <x-input id="payloadtogto" type="number" class="mt-1 block w-full" wire:model.live="rocket.payloadtogto" required />
            <x-input-error for="rocket.payloadtogto" class="mt-2" />
        </div>

        <!-- payloadtomars -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="payloadtomars" value="{{ __('Payload to Mars') }}" />    
            <x-input id="payloadtomars" type="number" class="mt-1 block w-full" wire:model.live="rocket.payloadtomars" required />
            <x-input-error for="rocket.payloadtomars" class="mt-2" />
        </div>

        
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmingRocketAdd', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="saveRocket" wire:loading.attr="disabled">
            {{ __('Save Customer') }}
        </x-danger-button>

    </x-slot>
</x-dialog-modal>


</div>
</div>