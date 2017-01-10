@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.Reset_password') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'action' => 'Auth\ResetPasswordController@reset', 
                        'class' => 'form-horizontal', 
                        'role' => 'form'
                    ]) !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans('auth.email') }}</label>

                            <div class="col-md-6">
                                {!! Form::email('email', $email or old('email'), [
                                    'id' => 'email',
                                    'class' => 'form-control', 
                                    'required' => 'true', 
                                    'autofocus' => '',
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
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {{ Form::label('password-confirm', trans('auth.confirm_password'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', [
                                    'class' => 'form-control', 
                                    'id' => 'password-confirm',
                                    'required' => 'true',
                                ]) !!}
                                @include('layouts.error-validate', ['title' => 'password_confirmation'])
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('auth.Reset_password'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
