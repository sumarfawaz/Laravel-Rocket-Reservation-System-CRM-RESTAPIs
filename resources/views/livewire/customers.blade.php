<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    <div class="mt-8 text-2xl">
        Customers
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
        <div class="mb-2"> <!-- Search Box -->
            <input wire:model.live.debounce.500ms="q" type="text" class="ms-3 px-4 py-2 border rounded" style="width: 100vh;" placeholder="Search...">
        </div>

            <div class="text-right"> <!-- Create Button -->
                <button style="border:1.7px solid black" wire:click="confirmCustomerAdd" class="px-4 py-2 rounded">Create</button>
            </div>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr style="text-align:center;">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">First Name</th>
                    <th class="px-4 py-2">Last Name</th>
                    <th class="px-4 py-2">E-Passport-ID</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Phone</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr style="text-align:center;">
                    <td class="border px-4 py-2">{{ $customer->id }}</td>
                    <td class="border px-4 py-2">{{ $customer->first_name }}</td>
                    <td class="border px-4 py-2">{{ $customer->last_name }}</td>
                    <td class="border px-4 py-2">{{ $customer->epassportid }}</td>
                    <td class="border px-4 py-2">{{ $customer->email }}</td>
                    <td class="border px-4 py-2">{{ $customer->phone_number }}</td>
                    <td class="border px-4 py-2">
                        <div wire:key="customer-{{ $customer->id }}">
                            <x-button wire:key="edit-button-{{ $customer->id }}" wire:click="confirmCustomerEdit({{ $customer->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                                Edit    
                            </x-button>
                            <x-danger-button wire:key="delete-button-{{ $customer->id }}" wire:click="confirmCustomerDeletion({{ $customer->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-50">
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
        {{ $customers->links() }} <!-- Pagination Links -->
    </div>

    <!-- Delete Customer Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingCustomerDeletion">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Customer?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingCustomerDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteItem({{ $confirmingCustomerDeletion }})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>


<!-- Add New Customer -->
<x-dialog-modal wire:model.defer="confirmingCustomerAdd">
    <x-slot name="title">
        {{ isset($customer->id) ? 'Edit Customer' : 'Add Customer' }}
    </x-slot>

    <x-slot name="content">
        <!-- E-Passport-ID -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="epassportid" value="{{ __('E-Passport-ID') }}" />
            <x-input id="epassportid" type="text" class="mt-1 block w-full" wire:model.live="customer.epassportid" required />
            <x-input-error for="customer.epassportid" class="mt-2" />   
        </div>
        <!-- First Name -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="first_name" value="{{ __('First Name') }}" />
            <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model.live="customer.first_name" required />
            <x-input-error for="customer.first_name" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="last_name" value="{{ __('Last Name') }}" />
            <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model.live="customer.last_name" required />
            <x-input-error for="customer.last_name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.live="customer.email" required />
            <x-input-error for="customer.email" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="phone_number" value="{{ __('Phone Number') }}" />
            <x-input id="phone_number" type="text" class="mt-1 block w-full" wire:model.live="customer.phone_number" required />
            <x-input-error for="customer.phone_number" class="mt-2" />
        </div>

        <!-- Occupation -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="occupation" value="{{ __('Occupation') }}" />
            <x-input id="occupation" type="text" class="mt-1 block w-full" wire:model.live="customer.occcupation" required />
            <x-input-error for="customer.occcupation" class="mt-2" />
        </div>

        <!-- Nationality -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="nationality" value="{{ __('Nationality') }}" />    
            <x-input id="nationality" type="text" class="mt-1 block w-full" wire:model.live="customer.nationality" required />
            <x-input-error for="customer.nationality" class="mt-2" />
        </div>

        <!-- Age -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="age" value="{{ __('Age') }}" />
            <x-input id="age" type="number" class="mt-1 block w-full" wire:model.live="customer.age" required />
            <x-input-error for="customer.age" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmingCustomerAdd', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="saveCustomer" wire:loading.attr="disabled">
            {{ __('Save Customer') }}
        </x-danger-button>

    </x-slot>
</x-dialog-modal>


</div>
