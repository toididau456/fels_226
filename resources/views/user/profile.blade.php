@extends('layouts.app')
@section('content')
	<div class="row">
		<h2 class="text-center"><b>Profile User</b></h2>
		<div class="col-md-offset-4 col-md-5">
			{!! Form::open(['action' => ['ProfileController@update', Auth::id()], 'method' => 'PUT']) !!}
				<div class="form-group">
					<input type="text" class="form-control" id="" placeholder="Input field">
				</div>
				{{ Form::submit('Submit') }}
			{!! Form::close() !!}
		</div>
	</div>

@stop