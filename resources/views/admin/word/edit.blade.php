@extends('layouts.admin')
@section('title', trans('user.admin.adWord.editWordTitle'))
@section('cate', trans('user.admin.adWord.editWordTitle'))
@section('content')
@include('layouts.error-status')
    {!! Form::open([
        'action' => ['Admin\WordController@update', $words->id], 
        'class' => 'form-horizontal', 
        'role' => 'form',
        'method' => 'PUT',
    ]) !!}
        <div class="form-group">
            {{ Form::label('Word') }}
            {!! Form::text('content', old('content', $words->content), [
                'class' => 'form-control',
                'placeholder' => trans('user.admin.placeWord'),
                'required' => 'true',
            ]) !!}
        </div>

        @foreach ($words->wordChoices as $wordChoice)
            <div class="form-group">
                <div class="col-md-2">
                    {{ Form::label('Word Choice') }}
                </div>
                <div class="col-md-6">
                    {!! Form::text('wordChoice[' . $wordChoice->id . ']', old('wordChoice', $wordChoice->content), [
                        'class' => 'form-control',
                        'placeholder' =>  trans('user.admin.placeWordChoice'),
                        'required' => 'true',
                     ]) !!}
                </div>
                @if ($wordChoice->correct)
                    <div class="col-md-3">
                        {!! Form::radio('Choice', $wordChoice->id, true) !!} isTrue   
                    </div>
                @else
                    <div class="col-md-3">
                        {!! Form::radio('Choice', $wordChoice->id) !!} isTrue   
                    </div>
                @endif
            </div>
        @endforeach
        <div class="form-group"> 
            <div class="col-md-2">
                {{ Form::label(trans('user.admin.addWord')) }}
            </div>
            <div class="col-md-6 col-md-offset-2">
               {!! Form::select('cate', $listCategories,$words->category_id) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                {!! Form::submit(trans('user.admin.cate.btnCateEdit'), ['class' => 'btn btn-default']) !!}
                {!! Form::reset(trans('user.admin.reset'), ['class' => 'btn btn-default']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection
