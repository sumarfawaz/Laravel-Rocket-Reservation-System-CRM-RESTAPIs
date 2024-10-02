<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use Livewire\WithPagination;


class Tickets extends Component
{
    use WithPagination;
    public $q;
    public $ticket = [];


    public function render()
    {
        $tickets = Ticket::query()
        ->when($this->q, function($query) {
            return $query->where('id', 'like', '%'.$this->q.'%')
            ->orWhere('epassportid', 'like', '%'.$this->q.'%')
            ->orWhere('scheduler_name', 'like', '%'.$this->q.'%')
            ->orWhere('total_price', 'like', '%'.$this->q.'%')
            ->orWhere('created_at', 'like', '%'.$this->q.'%');
        })
        ->paginate(10);
        return view('livewire.tickets',
        ['tickets' => $tickets]
    );
    }
}
