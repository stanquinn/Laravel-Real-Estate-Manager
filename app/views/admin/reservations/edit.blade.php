@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create Property</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                {{ Form::model($reservation, array('method' => 'PATCH', 'route' => array('admin.reservations.update', $reservation->id))) }}
                
                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'First Name:') }}
                        {{ Form::text('firstname',null,array('placeholder' => 'First name','class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Last Name:') }}
                        {{ Form::text('lastname',null,array('placeholder' => 'Last name','class' => 'form-control')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Phone:') }}
                        {{ Form::text('phone',null,array('placeholder' => 'Landline','class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Mobile:') }}
                        {{ Form::text('mobile',null,array('placeholder' => 'Mobile','class' => 'form-control')) }}
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Email:') }}
                        {{ Form::email('email',null,array('placeholder' => '','class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Tin Number:') }}
                        {{ Form::text('tin_number',null,array('placeholder' => 'Mobile','class' => 'form-control')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Home Address:') }}
                        {{ Form::text('home_address',null,array('placeholder' => '','class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Work Address:') }}
                        {{ Form::text('work_address',null,array('placeholder' => '','class' => 'form-control')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Nature of Work:') }}
                        {{ Form::text('work',null,array('placeholder' => '','class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Company:') }}
                        {{ Form::text('company',null,array('placeholder' => '','class' => 'form-control')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Unit Type') }}
                        {{ Form::select('unit_type',array('lot' => 'Lot Only', 'house and lot' => 'House and Lot'),null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Terms:') }}
                        {{ Form::select('terms',array('cash' => 'Cash', 'installment' => 'Installment','pagibig' => 'Pag-Ibig','in-house' => 'In-House'),null,array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        {{ Form::submit('Submit', array('class' => 'btn btn-info btn-large pull-right')) }}
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop