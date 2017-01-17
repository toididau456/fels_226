@extends('layouts.admin')
@section('title', trans('user.admin.adUser.titleAdd'))
@section('cate', trans('user.admin.adUser.titleAdd'))
@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <ul>
        @foreach ($errors->all() as $error)
        <li>
           {{ $error }}  
        </li>
        @endforeach
    </ul>
</div>
@endif
    {!! Form::open([
        'action' => 'Admin\UserController@store',
    ]) !!}
        @include('admin.user.common', [
            'trans' => 'user.admin.adUser.btnUserAdd',
        ])
    {!! Form::close() !!}
@endsection
