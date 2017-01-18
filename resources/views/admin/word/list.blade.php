@extends('layouts.admin')
@section('title', trans('user.admin.adUser.listUserHead'))
@section('cate', trans('user.admin.adUser.listUserTitle'))
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
   <thead>
      <tr align="center">
         <th>{{ trans('user.admin.id') }}</th>
         <th>{{ trans('user.admin.adWord.word') }}</th>
         <th>{{ trans('user.admin.adWord.category') }}</th>
         <th>{{ trans('user.admin.delete') }}</th>
         <th>{{ trans('user.admin.edit') }}</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($words as $word)
        <tr class="odd gradeX" align="center">
         <td>{{ $word->id }}</td>
         <td>{{ $word->content }}</td>
         <td>{{ $word->category->name }}</td>
         <td class="center">
            {!! Form::open([
               'action' => ['Admin\WordController@destroy', $word->id],
               'method' => 'DELETE',
               'class' => 'form-delete'
            ]) !!}
            {!! Form::submit(trans('user.admin.delete'), ['class' => 'btn btn-sm btn-default']) !!}
            {!! Form::close() !!}
         </td>
         <td class="center">
            <a href="{{ action('Admin\WordController@edit',$word->id) }}" type="button" class="btn btn-sm btn-default">{{ trans('user.admin.edit') }}</a>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
<div class="text-center">
   {{ $words->links() }}
</div>
@endsection