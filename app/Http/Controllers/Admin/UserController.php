<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Auth;
use Gate;
use DB;
use App\Models\User;
use App\Models\Lesson;
use App\Models\LessonWord;
use App\Models\Answer;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userResult = User::where('id', '<>', Auth::id())->paginate(config('common.number_pagination'));

        return view('admin.user.list', ['userResult' => $userResult]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->avatar = config('common.avatar');
        $user->save();

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userResult = User::find($id);

        return view('admin.user.edit', ['userResult' => $userResult]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        if ($request->password && $request->password_confirmation) {
            $user->password = $request->password;
        }
        
        $user->role = $request->role;
        $user->avatar = config('common.avatar');
        $user->save();

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $lessonIds = $user->lessons->pluck('id');
            LessonWord::whereIn('lesson_id', $lessonIds)->delete();
            Answer::whereIn('lesson_id', $lessonIds)->delete();
            $user->lessons()->delete();
            $user->following()->detach();
            $user->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            log::eror($e);
        }

        return response()->json(['status' => 'ok']);
    }
}
