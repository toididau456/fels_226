@extends('layouts.app')

@section('content')
    <div class="row" id="profile">
        <div class="container">
            <div class="col-md-3">
                @if (Auth::user()->avatar == 'default-avatar.png')
                    <img src="{{ asset('image/default-avatar.png') }}" alt="">
                @else
                    <img src="{{ asset('upload/'. Auth::user()->avatar) }}" alt="">
                @endif
            </div>
            <div class="col-md-6">
                <table class="tabler">
                    <tbody>
                    <tr>
                        <th>{{trans('user.contactInfo')}}</th>
                        <th>
                            <a href="{{ action('ProfileController@edit', Auth::id()) }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </th>
                    </tr>
                    <tr>
                        <td>{{trans('user.contactInfo')}}</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <th>{{trans('user.General Infomation')}}</th>
                    </tr>
                    <tr>
                        <td>{{trans('user.name')}}</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <br>
                    <tr>
                        <td>{{trans('user.status')}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm">
                                {{ Auth::user()->checkUser() ? 'Admin' : 'User' }}
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
