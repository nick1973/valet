@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div style="padding-bottom: 10px">
        <a class="btn btn-primary active" href="#">Active</a>
        {{--@if(Auth::user()->name === 'admin')--}}
            {{--<a class="btn btn-success" href="/reports">Reports</a>--}}
        {{--@endif--}}
        <a class="btn btn-warning col-xs-offset-2" href="/pre-booking">Pre Booked</a>
        <a class="btn btn-default pull-right" href="/history">History</a>
    </div>
    <div class="row">
        <div class="col-md-10 col-lg-5 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ $user->name }} You are logged in!</div>

                <div class="panel-body">
                    <a href="/home/create" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                    <h3 class="text-center" style="color: white">Active</h3>

                        <table width="" class="table" style="color: white;">
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Contact</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                            @foreach($tickets as $ticket)
                            <tr>
                                @if($ticket->ticket_key_safe=="")
                                    <td><i style="color: red" class="fa fa-key" aria-hidden="true"></i></td>
                                @else
                                    <td><i style="color: green" class="fa fa-key" aria-hidden="true"></i></td>
                                @endif
                                <td>{{ $ticket->ticket_number }}</td>
                                <td><div style="word-wrap: break-word; width: 100px">
                                    @if($ticket->existing_customer=="Yes")
                                        <i class="fa fa-asterisk" style="color: gold" aria-hidden="true"></i>
                                    @endif
                                        {{ $ticket->ticket_name }} {{ $ticket->ticket_mobile}}
                                    </div></td>
                                <td><a href="home/{{ $ticket->id }}" class="btn btn-success btn-sm">Pull</a></td>
                                <td><a href="home/{{ $ticket->id }}/edit" class="btn btn-default btn-sm">Edit</a></td>
                            </tr>
                            @endforeach
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".alert").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert").slideUp(500);
        });
    });
</script>
@endsection
