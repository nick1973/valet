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
                                <a href="/reallocate/{{ $ticket->id }}" class="btn btn-warning">Reallocate Ticket No</a>
                                @if($ticket->ticket_key_safe=="")
                                    <input id="keysafe" type="button" class="btn btn-danger pull-right" value="Key Not Safe">
                                @else
                                    <input id="keysafe" type="button" class="btn btn-success pull-right" value="Key is Safe">
                                @endif
                                <div id="submit-show" class="collapse">
                                    <input type="submit" class="btn bg-primary center-block" value="Save Changes">
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="color: white">Ticket Number</label>
                                {!! Form::text('ticket_number', null, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Reg</label>
                                {!! Form::text('ticket_registration', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Price</label>
                                <select name="ticket_price" class="form-control" id="ticket_price">
                                        <option>{{ $ticket->ticket_price }}</option>
                                        <option value="20">£20</option>
                                        <option value="0">VIP-FREE</option>
                                        <option value="10">Self drive-£10</option>

                                </select>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label style="color: white">Price</label>--}}
                                {{--{!! Form::select('ticket_price', ['20'=>'20','0'=>'VIP-FREE','10'=>'Self drive-£10'], 'ticket_price', ['class'=>'form-control']) !!}--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label style="color: white">Name</label>
                                {!! Form::text('ticket_name', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label style="color: white">Mobile</label>
                                {!! Form::text('ticket_mobile', null, ['class' => 'form-control']) !!}
                            </div>

                        <div class="form-group">
                            <label style="color: white">Booked in by</label>
                            <select name="booked_in_by" class="form-control" id="ticket_price">
                                @if(!empty($ticket->booked_in_by))
                                    <option>{{ $ticket->booked_in_by }}</option>
                                    <option>Amy Hamilton</option>
                                    <option>Arnoldo Mota</option>
                                    <option>Brian Duggan</option>
                                    <option>Dave Duggan</option>
                                    <option>Ellie Porterfield</option>
                                    <option>Fabio Barata</option>
                                    <option>Ivo Correir</option>
                                    <option>John Harris</option>
                                    <option>Joshua Little</option>
                                    <option>Nelson Fonseca</option>
                                    <option>Robert Jones</option>
                                    <option>Rui Jesus</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label style="color: white">Driver</label>
                            <select name="ticket_driver" class="form-control" id="ticket_price">
                                @if(!empty($ticket->ticket_driver))
                                    <option>{{ $ticket->ticket_driver }}</option>
                                    <option>Arnoldo Mota</option>
                                    <option>Brian Duggan</option>
                                    <option>Dave Duggan</option>
                                    <option>Ivo Correir</option>
                                    <option>John Harris</option>
                                    <option>Nelson Fonseca</option>
                                    <option>Robert Jones</option>
                                @endif
                            </select>
                        </div>

                            <div class="form-group">
                                <label style="color: white"></label>
                                @if($ticket->existing_customer=="Yes")
                                    <input id="existing_customer" type="button" class="btn btn-success"
                                           value="Is an Existing Customer">
                                @else
                                    <input id="existing_customer" type="button" class="btn btn-danger"
                                           value="Not an Existing Customer">
                                @endif
                                <div id="existing"></div>
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
                                <input type="submit" class="btn bg-primary center-block" value="Save Changes">
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
                $("#submit-show").removeClass('collapse');
            });
            
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
