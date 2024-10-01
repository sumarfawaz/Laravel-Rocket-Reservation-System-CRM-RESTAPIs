<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Schema;

class Customers extends Component
{
    use WithPagination;

    public $q; // Property to store search input
    public $customer = []; // Property to store customer data

    public $confirmingCustomerDeletion = false;
    public $confirmingCustomerAdd = false;

    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    // Validation rules
    public function getRules()
    {
        // Check if we are updating an existing customer
        if (isset($this->customer['id'])) {
            return [
                'customer.epassportid' => 'string|unique:customers,epassportid,' . $this->customer['id'] . '|max:255', // Ensure the epassportid is unique except for the current customer
                'customer.first_name' => 'sometimes|string|max:255',
                'customer.last_name' => 'sometimes|string|max:255',
                'customer.phone_number' => 'string|unique:customers,phone_number,' . $this->customer['id'] . '|max:255', // Ensure phone number is unique except for the current customer
                'customer.email' => 'sometimes|string|email|unique:customers,email,' . $this->customer['id'] . '|max:255', // Ensure email is unique except for the current customer
                'customer.age' => 'sometimes|integer|max:255',
                'customer.occcupation' => 'sometimes|string|max:255',
                'customer.nationality' => 'sometimes|string|max:255',
            ];
        }

        // Return rules for creating a customer
        return [
            'customer.epassportid' => 'required|string|unique:customers,epassportid|max:255',
            'customer.first_name' => 'required|string|max:255',
            'customer.last_name' => 'required|string|max:255',
            'customer.phone_number' => 'required|string|unique:customers,phone_number|max:255',
            'customer.email' => 'required|string|email|unique:customers,email|max:255',
            'customer.age' => 'required|integer|max:255',
            'customer.occcupation' => 'required|string|max:255',
            'customer.nationality' => 'required|string|max:255',
        ];
    }

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
        $this->confirmingCustomerDeletion = $id;
    }

    public function deleteItem(Customer $customer)
    {
        $customer->delete();
        $this->confirmingCustomerDeletion = false;
    }

    public function confirmCustomerAdd()
    {
        $this->customer = []; // Clear previous customer data
        $this->confirmingCustomerAdd = true;
    }

    public function confirmCustomerEdit($id)
    {
        // Fetch the customer from the database
        $customer = Customer::find($id);

        // Check if the customer exists
        if ($customer) {
            // Populate the $this->customer property with the customer's data
            $this->customer = $customer->toArray(); // Convert to array if needed for form binding
            
            // Open the modal for editing
            $this->confirmingCustomerAdd = true; // Change to true to show the modal
        } else {
            // Optionally handle the case where the customer doesn't exist
            session()->flash('error', 'Customer not found.');
        }
    }

    public function saveCustomer()
    {
        \Log::info('saveCustomer method triggered');
        
        // Validate the customer data using the appropriate rules
        $this->validate($this->getRules());

        if (isset($this->customer['id'])) {
            // Update the customer if the 'id' key exists
            $customer = Customer::find($this->customer['id']);
            $customer->update($this->customer);
            session()->flash('success', 'Customer updated successfully.');
            \Log::info('Customer updated successfully.');
        } else {
            try {
                // Create the customer if validation passed
                Customer::create([
                    'epassportid' => $this->customer['epassportid'],
                    'first_name' => $this->customer['first_name'],
                    'last_name' => $this->customer['last_name'],
                    'phone_number' => $this->customer['phone_number'],
                    'email' => $this->customer['email'],
                    'occcupation' => $this->customer['occcupation'], // Corrected typo
                    'nationality' => $this->customer['nationality'],
                    'age' => $this->customer['age']
                ]);
                session()->flash('success', 'Customer created successfully.');
                \Log::info('Customer created successfully.');
            } catch (\Illuminate\Validation\ValidationException $e) {
                \Log::error('Validation failed: ' . json_encode($e->errors()));
                session()->flash('error', 'Validation failed: Please check your inputs.');
            } catch (\Exception $e) {
                \Log::error('Error saving customer: ' . $e->getMessage());
                session()->flash('error', 'An error occurred while saving the customer. Please try again.');
            }
        }

        // Reset customer data and close the modal regardless of success or failure
        $this->confirmingCustomerAdd = false;
        $this->customer = [];
    }
}
