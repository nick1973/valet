<?php

namespace App\Http\Controllers;

use App\Tracking;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function carCount()
    {
        $card = Tracking::where('ticket_payment','Card Payment')->whereRaw('Date(created_at) = CURDATE()')->count();
        $cash = Tracking::where('ticket_payment','Cash Payment')->whereRaw('Date(created_at) = CURDATE()')->count();
        $not_paid = Tracking::where('ticket_payment','Not Paid')->whereRaw('Date(created_at) = CURDATE()')->count();
        $vip = Tracking::where('ticket_price','VIP-FREE')->whereRaw('Date(created_at) = CURDATE()')->count();
        $car_count = Tracking::whereRaw('Date(created_at) = CURDATE()')->count();



        return view('reports.car_count', compact('card', 'cash', 'not_paid', 'vip', 'car_count'));
    }
}
