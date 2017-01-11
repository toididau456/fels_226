@extends('layouts.admin')
@section('title',  trans('user.admin.cate.addHeadTitle') )
@section('cate', trans('user.admin.cate.addTittle'))
@section('content')

    @if(count($errors)>0)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['action' => 'Admin\CategoryController@store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
        <div class="form-group">
            {{ Form::label('Category Name') }}
            {!! Form::text('txtCateName', old('txtCateName'), [
                'class' => 'form-control',
                'placeholder' => 'Please Enter Category Name',
                'required' => 'true',
                'minlength' => 5,
                'maxlength' => 80,
            ]) !!}
        </div>
        <div class="form-group">
            {{ Form::label('Category Description') }}
            {{ Form::textarea('txtDescription', old('txtDescription'), [
                'size' => '20x10',
                'class' => 'form-control',
                'placeholder' => 'Please Enter Category description',
                'required' => 'true',
                'minlength' => 7,
                'maxlength' => 100,
            ]) }}
        </div>

        {!! Form::submit(trans('user.admin.cate.btnCateAdd'), ['class' => 'btn btn-default']) !!}
        {!! Form::reset(trans('user.admin.reset'), ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
@endsection
