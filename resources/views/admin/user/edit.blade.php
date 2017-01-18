@extends('layouts.admin')
@section('title', trans('user.admin.adUser.editHeadTitle'))
@section('cate', trans('user.admin.adUser.editTittle'))
@section('content')
@include('layouts.error-status')
    {!! Form::model($userResult, [
        'action' => ['Admin\UserController@update', $userResult->id],
        'method' => 'PUT',
    ]) !!}
        @include('admin.user.common', [
            'trans' => 'user.admin.adUser.btnUserEdit',
        ])
    {!! Form::close() !!}
@endsection
