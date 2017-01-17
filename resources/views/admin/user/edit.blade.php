@extends('layouts.admin')
@section('title', trans('user.admin.adUser.editHeadTitle'))
@section('cate', trans('user.admin.adUser.editTittle'))
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
    {!! Form::model($userResult, [
        'action' => ['Admin\UserController@update', $userResult->id],
        'method' => 'PUT',
    ]) !!}
        @include('admin.user.common', [
            'trans' => 'user.admin.adUser.btnUserEdit',
        ])
    {!! Form::close() !!}
@endsection
