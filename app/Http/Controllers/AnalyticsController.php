<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Rocket;
use App\Models\Ticket;
use App\Models\SpaceStation;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    // Method to get customer analytics by nationality
    public function getCustomerAnalyticsByNationality()
    {
        // Fetch all customers
        $customers = Customer::all();

        // Check if there are customers
        if ($customers->isEmpty()) {
            return response()->json(['message' => 'No customers found'], 404);
        }

        // Group customers by nationality
        $nationalities = $customers->groupBy('nationality');

        // Prepare an associative array where nationality is the key and count is the value
        $analyticsData = $nationalities->mapWithKeys(function ($group, $key) {
            return [$key => count($group)]; // Key is nationality, value is the count
        });

        // Return the data as JSON
        return response()->json($analyticsData);
    }

    // Method to get the total number of customers
    public function getCustomerCount()
    {
        $customerCount = Customer::count();
        return response()->json(['total_customers' => $customerCount]);
    }

    // Method to get the total number of rockets
    public function getRocketCount()
    {
        $rocketCount = Rocket::count();
        return response()->json(['total_rockets' => $rocketCount]);
    }

    // Method to get total sales from tickets
    public function getTotalSales()
    {
        // Get sum of total_price from all tickets
        $totalSales = Ticket::sum('total_price');
        return response()->json(['total_sales' => $totalSales]);
    }

    //Method to get total count of space stations
    public function getSpaceStationCount()
    {
        $spaceStationCount = SpaceStation::count();
        return response()->json(['total_space_stations' => $spaceStationCount]);
    }

    // Method to get ticket counts based on their creation dates
    public function getTicketsByCreationDate()
    {
        // Fetch all tickets with their creation date
        $tickets = Ticket::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Check if there are tickets
        if ($tickets->isEmpty()) {
            return response()->json(['message' => 'No tickets found'], 404);
        }

        // Prepare an associative array for the chart
        $analyticsData = $tickets->pluck('count', 'date');

        // Return the data as JSON
        return response()->json($analyticsData);
    }
    

}
