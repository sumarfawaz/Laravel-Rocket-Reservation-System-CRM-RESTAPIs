<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    <div class="mt-8 text-2xl">
        Customers
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
            <div class="mb-2"> <!-- Search Box -->
                <input wire:model.live.debounce.500ms="q" type="text" class="w-full px-4 py-2 border rounded" placeholder="Search...">
            </div>
            <div class="text-right"> <!-- Create Button -->
                <button style="border:1.7px solid black" wire:click="confirmCustomerAdd" class="px-4 py-2 rounded">Create</button>
            </div>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr>
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
                <tr>
                    <td class="border px-4 py-2">{{ $customer->id }}</td>
                    <td class="border px-4 py-2">{{ $customer->first_name }}</td>
                    <td class="border px-4 py-2">{{ $customer->last_name }}</td>
                    <td class="border px-4 py-2">{{ $customer->epassportid }}</td>
                    <td class="border px-4 py-2">{{ $customer->email }}</td>
                    <td class="border px-4 py-2">{{ $customer->phone_number }}</td>
                    <td class="border px-4 py-2">
                        <!-- Use a single button to trigger deletion confirmation -->
                        <x-danger-button wire:click="confirmCustomerDeletion({{ $customer->id }})" wire:loading.attr="disabled">
                            Delete
                        </x-danger-button>
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
<x-dialog-modal wire:model="confirmingCustomerAdd">
    <x-slot name="title">
        {{ __('Add Customer') }}
    </x-slot>

    <x-slot name="content">
        <!-- EPassPortId -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="epassportid" value="{{ __('E-Passport-ID') }}" />
            <x-input id="epassportid" type="text" class="mt-1 block w-full" wire:model.defer="customer.epassportid" required />
            <x-input-error for="customer.epassportid" class="mt-2" />   
        </div>
        <!-- First Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="first_name" value="{{ __('First Name') }}" />
            <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="customer.first_name" required />
            <x-input-error for="customer.first_name" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="last_name" value="{{ __('Last Name') }}" />
            <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="customer.last_name" required />
            <x-input-error for="customer.last_name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="customer.email" required />
            <x-input-error for="customer.email" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone_number" value="{{ __('Phone Number') }}" />
            <x-input id="phone_number" type="text" class="mt-1 block w-full" wire:model.defer="customer.phone_number" required />
            <x-input-error for="customer.phone_number" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmingCustomerAdd', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button class="ms-3" wire:click="saveCustomer" wire:loading.attr="disabled">
            {{ __('Save Customer') }}
        </x-button>
    </x-slot>
</x-dialog-modal>

</div>
