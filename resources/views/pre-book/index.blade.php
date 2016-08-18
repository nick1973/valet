@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div style="padding-bottom: 10px">
            <a class="btn btn-primary" href="/home">Active</a>
            {{--@if(Auth::user()->name === 'admin')--}}
            {{--<a class="btn btn-success" href="/reports">Reports</a>--}}
            {{--@endif--}}
            <a class="btn btn-warning col-xs-offset-2 active" href="/pre-booking">Pre Booked</a>
            <a class="btn btn-default pull-right" href="/history">History</a>
        </div>
        <div class="row">
            <div class="col-md-10 col-lg-5 col-md-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">{{ $user->name }} You are logged in!</div>

                    <div class="panel-body">
                        <a href="/pre-booking/create" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        <h3 class="text-center" style="color: white">Pre Booked</h3>

                        <table class="table" style="color: white">
                            <tr>
                                <th>Reg</th>
                                <th>Name</th>
                                <th>Action</th>

                            </tr>
                            @foreach($pre_books as $pre_booked)
                                <tr>
                                    <td style="text-transform:uppercase">{{ $pre_booked->ticket_registration }}</td>
                                    <td>
                                        {{ $pre_booked->ticket_name }}
                                    </td>
                                    @if($pre_booked->ticket_mobile && $pre_booked->ticket_price && $pre_booked->ticket_name
                                    && $pre_booked->booked_in_by && $pre_booked->ticket_driver)
                                        <td><a href="issue/{{ $pre_booked->id }}" class="btn btn-success btn-sm">Issue</a></td>
                                    @endif
                                    <td><a href="home/{{ $pre_booked->id }}/edit" class="btn btn-default btn-sm">Edit</a></td>
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
