@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Create a New Entry</div>
                    <div class="panel-body">
                        <form class="form-viritical" action="/home" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input value="<?php echo empty($ticket_number) ? "" : $ticket_number; ?>"
                                       name="ticket_number" type="text" class="form-control" id="ticket_number" placeholder="Ticket Number">
                            </div>
                            <div class="form-group">
                                <input name="ticket_registration" type="text" class="form-control" id="ticket_registration" placeholder="Registration">
                            </div>
                            <div class="form-group">
                                <select name="ticket_price" class="form-control" id="ticket_price">
                                    <option value="20">£20</option>
                                    <option value="0">VIP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input name="ticket_name" type="text" class="form-control" id="ticket_name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input name="ticket_mobile" type="tel" class="form-control" id="ticket_mobile" placeholder="Mobile">
                            </div>

                            {{--<div class="checkbox">--}}
                                {{--<label style="color: white">--}}
                                    {{--<input hidden value="No" name="existing_customer" type="checkbox">--}}
                                    {{--<input value="Yes" name="existing_customer" type="checkbox"> Existing Customer?--}}
                                {{--</label>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                    <input id="existing_customer" type="button" class="btn btn-danger"
                                           value="Not an Existing Customer">
                            </div>
                            <div id="existing"></div>

                            <div class="form-group">
                                <input name="ticket_manufacturer" type="text" class="form-control" id="ticket_manufacturer" placeholder="Manufacturer">
                            </div>
                            <div class="form-group">
                                <input name="ticket_model" type="text" class="form-control" id="ticket_model" placeholder="Model">
                            </div>
                            <div class="form-group">
                                <input name="ticket_colour" type="text" class="form-control" id="ticket_colour" placeholder="Colour">
                            </div>
                            <div class="form-group">
                                <textarea name="ticket_notes" class="form-control" placeholder="Notes:"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn bg-primary center-block" value="Done!">
                            </div>
                            <input name="ticket_status" type="text" value="active" hidden>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".alert").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert").slideUp(500);
            });

            $("#existing_customer").click(function () {
                $("#existing_customer").toggleClass('btn-danger').toggleClass('btn-success');
                if(this.value == 'Not an Existing Customer')
                {
                    this.value = 'Is an Existing Customer';
                    $('#existing').empty();
                    $('#existing').append("<input type='text' value='Yes' name='existing_customer' hidden />");
                }
                else {
                    this.value = 'Not an Existing Customer';
                    $('#existing').empty();
                    $('#existing').append("<input type='text' value='No' name='existing_customer' hidden />");
                }
            });
        });
    </script>
@endsection
