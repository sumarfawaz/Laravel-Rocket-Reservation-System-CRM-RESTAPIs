<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;
class TicketController extends Controller
{
    //

    public function index(){
        $tickets = Ticket::all();
        return response()->json([
            'status' => true,
            'message' => 'Tickets retrieved successfully',
            'data' => $tickets
        ], 200);
    }

    public function show($id){
        // Fetch Ticket by ID
        $tickets = Ticket::where('id', $id)->first();

        if($tickets){
            return response()->json($tickets, 200);
        }

        return response()->json(['message' => 'Ticket not found'], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'epassportid' => 'required|string|exists:customers,epassportid',
            'scheduler_name' => 'required|string|exists:schedulers,scheduler_name',
            'total_price' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $tickets = Ticket::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Ticket created successfully',
            'data' => $tickets
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Fetch the current ticket by ID
        $ticket = Ticket::where('id', $id)->first();

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'epassportid' => 'required|string|exists:customers,epassportid',
            'scheduler_name' => 'required|string|exists:schedulers,scheduler_name',
            'total_price' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $ticket->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Ticket updated successfully',
            'data' => $ticket
        ], 200);
    }


    public function destroy($id)
    {
        $ticket = Ticket::where('id', $id)->first();

        if ($ticket) {
            $ticket->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ticket deleted successfully'
            ], 200);
        }

        return response()->json(['message' => 'Ticket not found'], 404);
    }
}
