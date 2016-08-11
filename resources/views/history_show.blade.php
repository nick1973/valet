@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Ticket Number {{ $ticket->ticket_number }}</div>

                    <div class="panel-body">
                        <div class="col-xs-6">
                            <p style="color: white">Name</p>
                            <p style="color: white">Mobile</p>
                            <p style="color: white">Registration</p>
                            <p style="color: white">Existing Customer</p>
                            <p style="color: white">Manufacturer</p>
                            <p style="color: white">Model</p>
                            <p style="color: white">Colour</p>
                            <p style="color: white">Notes</p>
                            <p style="color: white">Price</p>
                        </div>

                        <div class="col-xs-6">
                            <p style="color: white"><?php echo empty($ticket->ticket_name) ? "Field Empty!" : $ticket->ticket_name; ?></p>
                            <p style="color: white"><?php echo empty($ticket->ticket_mobile) ? "Field Empty!" : $ticket->ticket_mobile; ?></p>
                            <p style="color: white"><?php echo empty($ticket->ticket_registration) ? "Field Empty!" : $ticket->ticket_registration; ?></p>
                            <p style="color: white"><?php echo empty($ticket->existing_customer) ? "No" : $ticket->existing_customer; ?></p>
                            <p style="color: white"><?php echo empty($ticket->ticket_manufacturer) ? "Field Empty!" : $ticket->ticket_manufacturer; ?></p>
                            <p style="color: white"><?php echo empty($ticket->ticket_model) ? "Field Empty!" : $ticket->ticket_model; ?></p>
                            <p style="color: white"><?php echo empty($ticket->ticket_colour) ? "Field Empty!" : $ticket->ticket_colour; ?></p>
                            <p style="color: white"><?php echo empty($ticket->ticket_notes) ? "Field Empty!" : $ticket->ticket_notes; ?></p>
                            {!! Form::model($ticket,[
                            'method' => 'PATCH',
                            'route' => ['home.update', $ticket->id],
                            'id'=>'priceForm']) !!}
                            {{ csrf_field() }}
                            <select name="ticket_price" class="form-control" id="ticket_price">
                                <option>{{ $ticket->ticket_price }}</option>
                                <option value="20">£20</option>
                                <option value="0">VIP</option>
                            </select>
                            <div id="paymentMethod" class="col-xs-12"></div>
                            </form>
                        </div>
                        <div class="col-xs-12 row" style="padding-bottom: 10px">
                            <a href="/history" class="btn btn-default pull-left">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
