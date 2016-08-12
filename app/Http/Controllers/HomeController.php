<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Tracking;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tickets = Tracking::where('ticket_status', 'active')->where('id','!=','1')->orderBy('created_at', 'desc')->get();
        if($user->name==='admin'){
            return view('reports.index', compact('user', 'tickets'));
        }
        return view('home', compact('user', 'tickets'));
    }

    public function history()
    {
        $user = Auth::user();
        $tickets = Tracking::where('ticket_status', 'complete')->orderBy('created_at', 'desc')->get();
        return view('history', compact('user', 'tickets'));
    }

    public function show($id)
    {
        $ticket = Tracking::find($id);
        return view('show', compact('ticket'));
    }

    public function historyShow($id)
    {
        $ticket = Tracking::find($id);
        return view('history_show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Tracking::find($id);
        return view('edit', compact('ticket'));
    }

    public function create()
    {
        $lastRecord = Tracking::latest('id')->where('ticket_status', 'active')->first();
        //return $lastRecord;
        $ticket_number = (int)$lastRecord->ticket_number;
        $ticket_number = sprintf('%03d', $ticket_number + 1);
        if($ticket_number==='121')
        {
            $ticket_number = '001';
        }
        return view('create', compact('ticket_number'));
    }

    public function reallocateTicket($id)
    {
        $old_data = Tracking::find($id);
        $old_data->update(['ticket_status' => 'deleted']);
        $lastRecord = Tracking::latest('id')->where('ticket_status', 'active')->first();
        //return $lastRecord;
        $ticket_number = (int)$lastRecord->ticket_number;
        $ticket_number = sprintf('%03d', $ticket_number + 1);
        if($ticket_number==='121')
        {
            $ticket_number = '001';
        }
        return view('create', compact('ticket_number', 'old_data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ticket_number' => 'required|max:3|min:3',
            'ticket_name' => 'required|max:255',
            'ticket_mobile' => 'required|numeric',
            'ticket_registration' => 'required',
            'booked_in_by' => 'required',
            'ticket_driver' => 'required'

        ]);
        $input = $request->all();
        $ticket_number = $request->input('ticket_number');
        // NO Ticket found
        if(Tracking::where('ticket_number', $ticket_number)->orderBy('id', 'desc')->first()==null)
        {
            Tracking::create($input);
            return redirect('home')->with('status', 'Ticket\'s Been Issued!')->withInput();
        }
            if (Tracking::where('ticket_number', $ticket_number)->orderBy('id', 'desc')->first()->exists()) {
                // NO Ticket found
                $ticket = Tracking::where('ticket_number', $ticket_number)->orderBy('id', 'desc')->first();

                if($ticket->ticket_status==='complete' || $ticket->ticket_status==='deleted')
                {
                    Tracking::create($input);
                    return redirect('home')->with('status', 'Ticket\'s Been Issued!')->withInput();
                }
                //return "Active";
            }
        return redirect()->back()->with('status', 'Ticket\'s still active!')->with('ticket_number',$ticket_number)->withInput();
    }

    public function update(Request $request, $id)
    {
        $ticket = Tracking::find($id);
        $input = $request->all();
        $ticket->update($input);
        return redirect()->route('home.index');
    }
}
