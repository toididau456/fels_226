@extends('layouts.admin')
@section('title',  trans('user.admin.cate.editHeadTitle') )
@section('cate', trans('user.admin.cate.editTittle'))
@section('content')
@include('layouts.error-status')
    {!! Form::open([
        'action' => ['Admin\CategoryController@update', $cateResult->id], 
        'method' => 'PUT', 
        'class' => 'form-horizontal', 
        'role' => 'form'
    ]) !!}
        <div class="form-group">
            {{ Form::label('Category Name') }}
            {!! Form::text('txtCateName', old('txtCateName', $cateResult->name), [
                'class' => 'form-control',
                'placeholder' => 'Please Enter Category Name',
                'required' => 'true',
                'minlength' => 5,
                'maxlength' => 80,
            ]) !!}
        </div>
        <div class="form-group">
            {{ Form::label('Category Description') }}
            {{ Form::textarea('txtDescription', old('txtDescription' , $cateResult->description), [
                'size' => '20x10',
                'class' => 'form-control',
                'placeholder' => 'Please Enter Category description',
                'required' => 'true',
                'minlength' => 7,
                'maxlength' => 100,
            ]) }}
        </div>

        {!! Form::submit(trans('admin.cate.btnCateEdit'), ['class' => 'btn btn-default']) !!}
        {!! Form::reset(trans('user.admin.reset'), ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
@endsection
