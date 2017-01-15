@extends('layouts.app')
<script>
</script>
@section('content')
    <div class="container">
        <div id="wordList">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    {!! Form::open([
                        'action' => 'WordListController@index',
                        'class' => 'form-inline',
                        'method' => 'GET',
                    ]) !!}
                    <div class="form-group">
                        {{ Form::label('Category ', null, ['class' => 'control-label']) }}
                        {!! Form::select('idCategory', $listCategories) !!}
                    </div>
                    <div class="form-group" id="status-radio">
                        <div class="radio">
                            {{ Form::label('All ', null, ['class' => 'control-label']) }}
                            {{  Form::radio('typeWord', config('myApp.wordList.all'), true) }}
                        </div>
                        <div class="radio">
                            {{ Form::label('Learned ', null, ['class' => 'control-label']) }}
                            {{  Form::radio('typeWord', config('myApp.wordList.learned')) }}
                        </div>
                        <div class="radio">
                            {{ Form::label('Not Learned ', null, ['class' => 'control-label']) }}
                            {{  Form::radio('typeWord', config('myApp.wordList.unleaned')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{  Form::submit('Filter', ['class' => 'btn btn-info btn-md']) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="info">
                            <th>Word Id</th>
                            <th>Word</th>
                            <th>Meaning</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($words as $word)
                            <tr>
                                <td>{{ $word->id }}</td>
                                <td>{{ $word->content }}</td>
                                <td>{{ $word->wordChoices->where('correct',1)->first()['content'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="wordList-paginate">
                    {{ $words->appends([
                        'idCategory' => app('request')->input('idCategory'),
                        'typeWord' => app('request')->input('typeWord'),
                    ])->links() }}
                </div>
                </div>
                <br>
            </div>
        </div>
    </div>
@stop
