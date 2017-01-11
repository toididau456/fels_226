@extends('layouts.admin')
@section('title', trans('user.admin.adUser.listUserHead'))
@section('cate', trans('user.admin.adUser.listUserTitle'))
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
   <thead>
      <tr align="center">
         <th>{{ trans('user.admin.id') }}</th>
         <th>{{ trans('user.admin.adUser.username') }}</th>
         <th>{{ trans('user.admin.adUser.level') }}</th>
         <th>{{ trans('user.admin.delete') }}</th>
         <th>{{ trans('user.admin.edit') }}</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($userResult as $v)
        <tr class="odd gradeX" align="center">
         <td>{{ $v->id }}</td>
         <td>{{ $v->name }}</td>
         <td>
            {{ ($v->role == 1) ? 'Admin' : 'User' }}
         </td>
         <td class="center">
            <button id="delete" data-url="{{ action('Admin\UserController@destroy',$v->id) }}">Delete</button>
         </td>
         <td class="center">
            <a href="{{ action('Admin\UserController@edit', $v->id) }}" 
               type="button" class="btn btn-sm btn-default">{{ trans('user.admin.edit') }}</a>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
<div class="text-center">
   {{ $userResult->links() }}
</div>
@endsection
