<?php

namespace App\Http\Controllers;

use App\Tracking;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PreBookController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pre_books = Tracking::where('ticket_status', 'pre booked')->get();
        return view('pre-book.index', compact('user', 'pre_books'));
    }

    public function create()
    {
        return view('pre-book.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //'auth_by' => 'required',
            'ticket_name' => 'required|max:255',
            'ticket_registration' => 'required',
        ]);
        $input = $request->all();
        Tracking::create($input);
        return redirect('pre-booking')->with('status', 'Ticket\'s Been Booked!');
    }

    public function issueTicket($id)
    {
        $old_data = Tracking::find($id);
        $lastRecord = Tracking::latest('ticket_number')->where('ticket_status', 'active')->first();
        $ticket_number = (int)$lastRecord->ticket_number;
        $ticket_number = sprintf('%03d', $ticket_number + 1);
        if($ticket_number==='121')
        {
            $ticket_number = '001';
        }
        $old_data->update(['ticket_status' => 'active', 'ticket_number' => $ticket_number]);
        return redirect('home')->with('status', 'Ticket\'s Been Issued!');
    }
}
