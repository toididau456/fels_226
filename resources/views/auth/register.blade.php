@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.register') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'action' => 'Auth\RegisterController@showRegistrationForm',
                        'class' => 'form-horizontal', 
                        'role' => 'form',
                    ])!!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', trans('auth.name'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {!! Form::text('name', old('name'), [
                                    'class' => "form-control",
                                    'required' => 'true',
                                    'autofocus' => 'true',
                                ]) !!}
                                @include('layouts.error-validate', ['title' => 'name'])
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('auth.email'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {!! Form::text('email', old('email'), [ 
                                    'class' => "form-control",
                                    'required' => 'true',
                                ]) !!}
                                @include('layouts.error-validate', ['title' => 'email'])
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', trans('auth.password'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {!! Form::password('password', [
                                    'class' => 'form-control', 
                                    'id' => 'password', 
                                    'required' => 'true',
                                ]) !!}
                                @include('layouts.error-validate', ['title' => 'password'])
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('password-confirm', trans('auth.confirm_password'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', [
                                    'class' => 'form-control', 
                                    'id' => 'password-confirm',
                                    'required' => 'true',
                                ])!!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('auth.register'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
