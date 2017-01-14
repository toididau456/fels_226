<h3>{{ trans('Home.profile.activities') }}</h3>
<div class="row" id="list-friend">
<table class="table table-hover table-condensed">
    <thead>
        <tr class="info">
            <th>{{ trans('Home.profile.activityPage.category') }}</th>
            <th>{{ trans('Home.profile.activityPage.score') }}</th>
            <th>{{ trans('Home.profile.activityPage.time') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lessons as $lesson)
            <tr>
                <td>{{ $lesson->category['name']}}</td>
                <td>
                    {{ $lesson->rightWords()->count('words.id') }}
                    /
                    {{ $lesson->words()->count('words.id') }}
                </td>
                <td>
                {{ $lesson->created_at }}
                </td>
                <td><button type="button" class="btn btn-success">{{ trans('Home.profile.activityPage.view') }}</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
<div class="text-center" id="user-activities-paginate">
    {{ $lessons->links() }}
</div>
