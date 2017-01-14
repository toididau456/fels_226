<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use App\Models\User;
use App\Models\Follower;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Word;
use DB;
use Auth;
use File;
use Gate;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $userId = $id ? $id : Auth::id();

        if (request()->ajax()) {
            return $this->ajaxActivities($userId);
        }

        $user = User::find($userId);

        return view('user.profile', [
                'numberWordLearned' => Word::learned($user->id)->count(),
                'user' => $user,
            ]);
    }
    public function ajaxProfileFollow($id, $type = null)
    {
        //Type. 1 get Following, 2. get Follwer. Default get All User
        $user = User::find($id);
        switch ($type) {
            case '1':
                $user = $user->following->paginate(4);
                $title = "Following";
                break;
            case '2':
                $user = $user->followers->paginate(4);
                $title =  "Follower";
                break;
            default:
                $user = User::paginate(4);
                $title =  "User";
                break;
        }
        
        return view('pages.ajaxProfile', ['user' => $user, 'title' => $title]);
    }
    public function ajaxFollow($id)
    {
        Auth::user()->following()->toggle($id);
    }
    public function ajaxActivities($id)
    {
        $lessons = User::findOrFail($id)->lessons()->paginate(config('common.number_pagination'));
        return view('pages.ajaxActivities', ['lessons' => $lessons]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('edit-user', $id)) {
            abort(503);
        }

        return view('user.editProfile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $user = User::find($id);
        if (Auth::user()->social_name == null && $request->password != "") {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('fimage')) {
            $myImg = config('myApp.upload') . Auth::user()->avatar;
            if (file_exists($myImg) && Auth::user()->avatar != 'default-avatar.png') {
                File::delete($myImg);
            }

            $file = $request->fimage;
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            $user->avatar = $fileName;
            $file->move(public_path(config('myApp.upload')), $fileName);
        }
        
        $user->name = $request->txtName;
        $user->save();
        
        return redirect()->action('ProfileController@index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
