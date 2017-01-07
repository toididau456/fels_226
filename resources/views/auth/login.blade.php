@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.login') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'action' => 'Auth\LoginController@login', 
                        'class' => 'form-horizontal', 
                        'role' => 'form'
                    ]) !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('auth.email'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), [
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
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 btn-social-s">
                                <a class="btn btn-block btn-social btn-facebook" href="{{ url('auth/facebook') }}">
                                    <i class="fa fa-facebook"   aria-hidden="true"></i> {{ trans('auth.login_fb') }}
                                </a>
                                <a class="btn btn-block btn-social btn-google" href="{{ url('auth/google') }}">
                                    <i class="fa fa-google-plus" aria-hidden="true"></i> {{ trans('auth.login_gg') }}
                                </a>
                                <div class="checkbox">
                                    {!! Form::checkbox('remember'); !!} 
                                    {{ Form::label(trans('auth.remember'), null) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
                                {!! link_to_action(
                                    'Auth\ForgotPasswordController@showLinkRequestForm',
                                    trans('auth.Forgot'), 
                                    ['class' => 'btn btn-link']
                                ); !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
