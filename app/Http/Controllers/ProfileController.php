<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Gate;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile');
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
