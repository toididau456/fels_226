@extends('layouts.app')

@section('content')
    <div class="row" id="profile">
        <div class="container">
			<div class="col-md-3">
				<img src="{{ asset('image/default-avatar.png') }}" alt="">
			</div>
            <div class="col-md-6">
                <table class="tabler">
                    <tbody>
                        <tr>
                            <th>Contact Infomation</th>
                            <th>
								<a href="{{ action('ProfileController@edit', Auth::id()) }}">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
                            </th>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>General Infomation</th>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <br>
                        <tr>
                            <td>Status</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm">
                                    {{ Auth::id() == 1 ? 'Admin' : 'User' }}
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop