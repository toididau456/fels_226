@extends('layouts.admin')
@section('title', trans('user.admin.adUser.titleAdd'))
@section('cate', trans('user.admin.adUser.titleAdd'))
@section('content')
@include('layouts.error-status')
    {!! Form::open([
        'action' => 'Admin\UserController@store',
    ]) !!}
        @include('admin.user.common', [
            'trans' => 'user.admin.adUser.btnUserAdd',
        ])
    {!! Form::close() !!}
@endsection
