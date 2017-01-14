@extends('layouts.app')

@section('content')
    <div id="profile">
        <div class="container">
            <div class="col-md-3">
                @include('layouts.imgUser')
            </div>
            <div class="col-md-6">
                <table class="tabler">
                    <tbody>
                        <tr>
                            <th>{{trans('user.contactInfo')}}</th>
                            @if ($user->isCurrent())
                                <th>
                                    <a href="{{ action('ProfileController@edit', Auth::id()) }}" class="btn btn-default">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        {{ trans('Home.profile.editUser') }}
                                    </a>
                                </th>
                            @endif
                        </tr>
                        <tr>
                            <td>{{trans('user.contactInfo')}}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>{{trans('user.generalInfo')}}</th>
                        </tr>
                        <tr>
                            <td>{{trans('user.name')}}</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <br>
                        <tr>
                            <td>{{trans('user.status')}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">
                                    {{ $user->isAdmin() ? trans('user.titAdmin') : trans('user.admin.user1') }}
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <ul id="profile-status">
                    <li>
                        <a href="javasript:void(0)" id="{{ $user->id }}">
                           <i class="fa fa-user-plus" aria-hidden="true"></i> 
                           {{ $user->following()->count() }} {{ trans('Home.profile.following') }}
                        </a>
                    </li>
                    <li>
                        <a href="javasript:void(0)" id="{{ $user->id }}">
                            <i class="fa fa-users" aria-hidden="true"></i> 
                            {{ $user->followers()->count() }} {{ trans('Home.profile.Follower') }}
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-vimeo" aria-hidden="true"></i>
                            {{ $numberWordLearned }} {{ trans('Home.profile.word') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                  <div class="list-group" id="sidebar-profile">
                    <a href="javasript:void(0)" class="list-group-item active" id="{{ $user->id }}">{{ trans('Home.profile.activities') }}</a>
                    <a href="javasript:void(0)" class="list-group-item btn-follow" id="{{ $user->id }}"> {{ trans('Home.profile.follow') }}</a>
                    <a href="javasript:void(0)" class="list-group-item btn-follow" id="{{ $user->id }}"> {{ trans('Home.profile.user') }}</a>
                  </div>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <div id="sidebar-main">
                    @include('pages.ajaxActivities', ['lessons' => $user->lessons()->paginate(config('common.number_pagination'))])
                </div>
            </div>
        </div>
    </div>
@stop
