<h3>{!! $title !!}</h3>
<div class="row" id="list-friend">
@foreach ($user as $value)
    <div id="user-box" class="col-md-4">
        <a href="{{ asset('profile/'.$value->id) }}">
            @if ($value->avatar == 'default-avatar.png') 
                <img src="{{ asset('image/'.$value->avatar) }}" alt="">
            @else 
                <img src="{{ asset('upload/'.$value->avatar) }}" alt="">
            @endif
        </a>
        <a href="javasript:void(0)">
            <span>{{ $value->name }}</span>
            @if (Auth::user()->checkFollowed($value->id)) 
                <button type="button" class="btn btn-info btn-md" id="{{ $value->id }}">{{ trans('Home.profile.following') }}</button>
            @else 
                <button type="button" class="btn btn-danger btn-md" id="{{ $value->id }}">{{ trans('Home.profile.follow') }}</button>  
            @endif
        </a>
    </div>
@endforeach
</div>
<div class="text-center" id="user-paginate">
    {{ $user->links() }}
</div>