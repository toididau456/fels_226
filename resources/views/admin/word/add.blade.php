@extends('layouts.admin')
@section('title', trans('user.admin.adWord.addWordTitle'))
@section('cate', trans('user.admin.adWord.addWordTitle'))
@section('content')
@include('layouts.error-status')
    {!! Form::open(['action' => 'Admin\WordController@store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
        <div class="form-group">
            {{ Form::label('Word') }}
            {!! Form::text('content', old('content'), [
                'class' => 'form-control',
                'placeholder' => trans('user.admin.placeWord'),
                'required' => 'true',
                'minlength' => 1,
                'maxlength' => 80,
            ]) !!}
        </div>
        @for ($i = 0; $i < 4; $i++)
            <div class="form-group">
                <div class="col-md-2">
                    {{ Form::label('Word Choice') }}
                </div>
                <div class="col-md-6">
                    {!! Form::text('wordChoice[' . $i . ']', old('wordChoice'), [
                        'class' => 'form-control',
                        'placeholder' => trans('user.admin.placeWordChoice'),
                        'required' => 'true',
                        'minlength' => 1,
                        'maxlength' => 80,
                     ]) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::radio('Choice', $i, true) !!} isTrue   
                </div>
            </div>
        @endfor
        <div class="form-group"> 
            <div class="col-md-2">
                {{ Form::label(trans('user.admin.addWord')) }}
            </div>
            <div class="col-md-6 col-md-offset-2">
               {!! Form::select('cate', $listCategories) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                {!! Form::submit(trans('user.admin.cate.btnCateAdd'), ['class' => 'btn btn-default']) !!}
                {!! Form::reset(trans('user.admin.reset'), ['class' => 'btn btn-default']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection
