@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading"> You are logged in!</div>

                    <div class="panel-body">
                        {!! Form::model($ticket,[
                            'method' => 'PATCH',
                            'route' => ['home.update', $ticket->id],
                            'class' => '']) !!}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label style="color: white">Ticket Number</label>
                                {!! Form::text('ticket_number', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Reg</label>
                                {!! Form::text('ticket_registration', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Price</label>
                                {!! Form::select('ticket_price', [''=>'','20'=>'20'], null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Name</label>
                                {!! Form::text('ticket_name', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Mobile</label>
                                {!! Form::text('ticket_mobile', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="checkbox">
                                <label style="color: white">
                                    @if($ticket->existing_customer=='Yes')
                                        <input type="checkbox" value="No" name="existing_customer" checked hidden/>
                                        <input type="checkbox" value="Yes" name="existing_customer" {{$ticket->existing_customer=='Yes' ? 'checked' : ''}} />
                                    @else
                                        <input type="checkbox" value="Yes" name="existing_customer"/>
                                    @endif
                                    Existing Customer?
                                </label>
                            </div>
                            <div class="form-group">
                                <label style="color: white">Manufacturer</label>
                                {!! Form::text('ticket_manufacturer', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Model</label>
                                {!! Form::text('ticket_model', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Colour</label>
                                {!! Form::text('ticket_colour', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Notes</label>
                                {!! Form::text('ticket_notes', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                @if($ticket->ticket_key_safe=="")
                                    <input id="keysafe" type="button" class="btn btn-danger" value="Key Not Safe">
                                @else
                                    <input id="keysafe" type="button" class="btn btn-success" value="Key is Safe">
                                @endif
                                <input type="submit" class="btn bg-primary center-block" value="Done!">
                            </div>
                        <div id="safe"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#keysafe").click(function () {
                $("#keysafe").toggleClass('btn-danger').toggleClass('btn-success');
                if(this.value == 'Key Not Safe')
                {
                    this.value = 'Key is Safe';
                    $('#safe').append("<input type='text' value='safe' name='ticket_key_safe' hidden />");
                }
                else {
                    this.value = 'Key Not Safe';
                    $('#safe').append("<input type='text' value='' name='ticket_key_safe' hidden />");
                }
            });
        });
    </script>
@endsection
