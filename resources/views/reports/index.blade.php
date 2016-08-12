@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-lg-12 col-md-offset-1 col-lg-offset-0">
                <div class="panel panel-success">
                    <div class="panel-heading">Reports</div>
                    <div class="panel-body" style="background: #EEEEEE">
                        <table id="reports" class="stripe" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Reg</th>
                                <th>Mobile</th>
                                <th>Booked in By</th>
                                <th>Driver</th>
                                <th>Price</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

    $(document).ready( function () {
        var table = $('#reports').DataTable( {
            "ajax": "/all-tickets",
            //"paging": false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ],
            "columns": [
                { "data": "ticket_number" },
                { "data": "ticket_name" },
                { "data": "ticket_registration" },
                { "data": "ticket_mobile" },
                { "data": "booked_in_by" },
                { "data": "ticket_driver" },
                { "data": "ticket_price" },
                { "data": "ticket_payment" },
                { "data": "ticket_status" },
                { "data": "created_at" },
            ]
        } );
    } );
</script>




@endsection