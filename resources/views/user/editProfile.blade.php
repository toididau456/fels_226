@extends('layouts.app')

@section('content')
    <div class="row" id="edit-profile">
        <h2 class="text-center">
            <b>{{ trans('user.profile') }}</b>
        </h2>
        <br> <br>
		<div class="col-md-offset-3 col-md-6">
        {!! Form::open(['action' => ['ProfileController@update', Auth::id()], 'method' => 'PUT']) !!}
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user-md" aria-hidden="true"></i>
                    </div>
                    {!!  Form::text('txtName', Auth::user()->name, [
                        'class' => 'form-control',
                        'required' => 'true',
                    ]) !!}
                </div>
                @include('layouts.error-validate', ['title' => 'txtName'])
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    {!!  Form::email('txtEmail', Auth::user()->email, [
                        'class' => 'form-control',
                        'required' => 'true',
                    ]) !!}
                </div>
                @include('layouts.error-validate', ['title' => 'txtEmail'])
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-key" aria-hidden="true"></i>
                    </div>
					{!! Form::password('password', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter PassWord',
                    ]); !!}
                </div>
                @include('layouts.error-validate', ['title' => 'password'])
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                    {!! Form::password('password_confirm', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Confirm PassWord',
                    ]); !!}
                </div>
                @include('layouts.error-validate', ['title' => 'password_confirm'])
                <div class="form-group">
                    {!! Form::file('fImage') !!}
                </div>
                @include('layouts.error-validate', ['title' => 'fImage'])
				{{ Form::submit('Submit',['class' => 'btn btn-info']) }}
			{!! Form::close() !!}
		</div>
	</div>
@stop