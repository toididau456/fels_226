<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Word;
use App\Models\WordChoice;
use App\Models\Lesson;
use App\Http\Requests\CateRequest;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cateResult = Category::paginate(config('common.number_pagination'));

        return view('admin.cate.list', ['cateResult' => $cateResult]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cate.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CateRequest $request, Category $cate)
    {
        $cate->name = $request->txtCateName;
        $cate->description = $request->txtDescription;
        $cate->save();
        
        return redirect()->action('Admin\CategoryController@index');
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
        $cateResult = Category::find($id);

        return view('admin.cate.edit', ['cateResult' => $cateResult]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CateRequest $request, $id)
    {
        $cate = Category::find($id);
        $cate->name = $request->txtCateName;
        $cate->description = $request->txtDescription;
        $cate->save();

        return redirect()->action('Admin\CategoryController@index');
        //sua
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
            $cate = Category::find($id);
            $cate->wordChoices()->delete();
            $cate->answer()->delete();
            $lessonResult = $cate->lessons;
            foreach ($lessonResult as $value) {
                Lesson::find($value->id)->words()->detach();
            }
            $cate->words()->delete();
            $cate->lessons()->delete();
            Category::destroy($id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            log::eror($e);
            return redirect()->action('Admin\CategoryController@index')->with(['status' => 'Remove Category Fail']);
        }
        
        return redirect()->action('Admin\CategoryController@index');
    }
}
