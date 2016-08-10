<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Tracking;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
        $tickets = Tracking::where('ticket_status', 'active')->orderBy('ticket_number', 'asc')->get();
        return view('home', compact('user', 'tickets'));
    }

    public function show($id)
    {
        $ticket = Tracking::find($id);
        return view('show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Tracking::find($id);
        return view('edit', compact('ticket'));
    }

    public function create()
    {
//        $lastRecord = Tracking::latest('id')->where('ticket_status', 'active')->first();
//        if($lastRecord==null)
//        {
//            Tracking::create(['ticket_number', 000]);
//        }
        $lastRecord = Tracking::latest('id')->where('ticket_status', 'active')->first();
        //return $lastRecord;
        $ticket_number = (int)$lastRecord->ticket_number;
        $ticket_number = sprintf('%03d', $ticket_number + 1);
        if($ticket_number==='101')
        {
            $ticket_number = '001';
        }
        return view('create', compact('ticket_number'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $ticket_number = $request->input('ticket_number');
        //$update = $request->except(['_method', '_token']);
        //LOOK TO SEE IF TICKET EXISTS AND HAS BEEN COMPLETED AND CREATE A NEW ONE WITH SAME TICKET NUMBER
//        if(Tracking::where('ticket_number', '=', 100)->exists())
//        {
//            $ticket_number = 001;
//            //return $ticket_number;
//        }
        if (Tracking::where('ticket_number', $ticket_number)->orderBy('id', 'desc')->first()->exists()) {
            // Ticket found
            //->where('ticket_status', 'complete')
            $ticket = Tracking::where('ticket_number', $ticket_number)->orderBy('id', 'desc')->first();

                if($ticket->ticket_status==='complete')
                {
                    Tracking::create($input);
                    //return "Complete";
                }
            //return "Active";
        }
        return redirect()->back()->with('status', 'Ticket still active!');
    }

    public function update(Request $request, $id)
    {
        $ticket = Tracking::find($id);
        $input = $request->all();
        $ticket->update($input);
        return redirect()->route('home.index');
    }
}
