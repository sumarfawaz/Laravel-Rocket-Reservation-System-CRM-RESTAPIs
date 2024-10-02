<div class="container">


<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

<h1 class="h3 mb-3"><strong>View Tickets</strong></h1>
    <div class="mt-8 text-2xl">
        
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
        <div class="mb-2"> <!-- Search Box -->
            <input wire:model.live.debounce.500ms="q" type="text" class="ms-3 px-4 py-2 border rounded" style="width: 100vh;" placeholder="Search...">
        </div>

            <!-- <div class="text-right>
                <button style="border:1.7px solid black" wire:click="confirmTicketAdd" class="px-4 py-2 rounded">Create</button>
            </div> -->

        </div>

        <table class="table-auto w-full">
            <thead>
                <tr style="text-align:center;">
                    <th class="px-4 py-2">Ticket ID</th>
                    <th class="px-4 py-2">E-Passport-ID</th>
                    <th class="px-4 py-2">Scheduler Name</th>
                    <th class="px-4 py-2">Ticket Price</th>
                    <th class="px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr style="text-align:center;">
                    <td class="border px-4 py-2">{{ $ticket->id }}</td>
                    <td class="border px-4 py-2">{{ $ticket->epassportid }} </td>
                    <td class="border px-4 py-2">{{ $ticket->scheduler_name }} </td>
                    <td class="border px-4 py-2">{{ $ticket->total_price }} </td>
                    <td class="border px-4 py-2">{{ $ticket->created_at }} </td>
                    <!-- <td class="border px-4 py-2">
                        <div wire:key="customer-{{ $ticket->id }}">
                            <x-button wire:key="edit-button-{{ $ticket->id }}" wire:click="confirmTicketEdit({{ $ticket->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                                Edit    
                            </x-button>
                            <x-danger-button wire:key="delete-button-{{ $ticket->id }}" wire:click="confirmTicketDelete({{ $ticket->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                                Delete
                            </x-danger-button>
                        </div>
                    </td> -->
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-8">
            {{ $tickets->links() }} <!-- Pagination Links -->
        </div>

</div>

</div>