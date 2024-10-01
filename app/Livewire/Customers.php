<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;

    public $q; // Property to store search input
    public $customer = [];


    public $confirmingCustomerDeletion = false;
    public $confirmingCustomerAdd = false;


    protected $rules = [
            'epassportid' => 'required|string|unique:customers|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:customers|max:255',
            'email' => 'required|string|email|unique:customers|max:255',
            'age' => 'required|integer|max:255',
            'occcupation' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
    ];

    // Reset pagination when the search term is updated
    public function updatingQ()
    {
        $this->resetPage(); // Resets to the first page whenever the search term is updated
    }

    public function render()
    {
        // Build the customer query
        $customers = Customer::query()
            ->when($this->q, function ($query) {
                // Apply the search term filtering for 'epassportid' or 'first_name'
                $query->where('epassportid', 'like', '%' . $this->q . '%')
                    ->orWhere('first_name', 'like', '%' . $this->q . '%')
                    ->orWhere('last_name', 'like', '%' . $this->q . '%')
                    ->orWhere('phone_number', 'like', '%' . $this->q . '%')
                    ->orWhere('email', 'like', '%' . $this->q . '%');
            })
            ->paginate(10); // Paginate the results, 10 customers per page

        // Return the view with customers
        return view('livewire.customers', [
            'customers' => $customers,
        ]);
    }

    public function confirmCustomerDeletion($id)
    {
        // $item->delete();
        $this->confirmingCustomerDeletion = $id;
    }

    public function deleteItem(Customer $customer)
    {
        $customer->delete();
        $this->confirmingCustomerDeletion = false;
    }
    public function confirmCustomerAdd()
    {
        $this->confirmingCustomerAdd = true;
    }
}
