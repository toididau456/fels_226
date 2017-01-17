@extends('layouts.admin')
@section('title','Danh Sach Category')
@section('cate','Thêm Category')
@section('content')
    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th><centrer>{{ trans('user.admin.id') }}</centrer></th>
            <th><centrer>{{ trans('user.admin.name') }}</centrer></th>
            <th><centrer>{{ trans('user.admin.description') }}</centrer></th>
            <th><centrer>{{ trans('user.admin.edit') }}</centrer></th>
            <th><centrer>{{ trans('user.admin.edit') }}</centrer></th>
        </tr>
        </thead>
        <tbody>
        @foreach($cateResult as $v)
            <tr class="gradeX" align="center">
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{str_limit($v->description, 15)}}</td>
                <td class="center">
                    {!! Form::open([
                       'action' => ['Admin\CategoryController@destroy', $v -> id],
                       'method' => 'DELETE',
                       'class' => 'form-delete',
                    ]) !!}
                    {!! Form::submit(trans('user.admin.delete'), ['class' => 'btn btn-sm btn-default']) !!}
                    {!! Form::close() !!}
                </td>
                <td class="center">
                    <a href="{{ action('Admin\CategoryController@edit',$v->id) }}" type="button" class="btn btn-sm btn-default">{{ trans('user.admin.edit') }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{ $cateResult->links() }}
    </div>
@endsection
