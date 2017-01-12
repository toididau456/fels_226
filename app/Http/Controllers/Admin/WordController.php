<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Word;
use App\Models\Category;
use App\Models\WordChoice;
use App\Http\Requests\WordRequest;
use DB;
use App\Helpers\MyHelper;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $words = Word::with('category')->paginate(config('common.number_pagination'));
        return view('admin.word.list', ['words' => $words]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.word.add', [
                'listCategories' =>  Category::pluck('name', 'id'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordRequest $request, Word $word)
    {
        DB::beginTransaction();
        try {
            $word->content = $request->content;
            $word->category_id = $request->cate;
            $word->save();
            foreach ($request->wordChoice as $key => $wChoice) {
                $wordChoice = new WordChoice;
                $wordChoice->content = $wChoice;
                $wordChoice->word_id = $word->id;
                if ($key == $request->Choice) {
                    $wordChoice->correct = 1;
                } else {
                    $wordChoice->correct = 0;
                }

                $wordChoice->save();
            }
            DB::commit();
        } catch (Exception $e) {
            log::error($e);
            DB::rollBack();
            return redirect()->back();
        }

        return redirect()->action('Admin\WordController@index');
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
        $words = Word::findOrFail($id);
        
        return view('admin.word.edit', [
                 'words' => $words,
                 'listCategories' => Category::pluck('name', 'id'),
             ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WordRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $word = Word::findOrFail($id);
            $word->content = $request->content;
            $word->category_id = $request->cate;
            $word->save();
            foreach ($request->wordChoice as $id => $wChoice) {
                $wordChoice = WordChoice::findOrFail($id);
                $wordChoice->content = $wChoice;
                if ($id == $request->Choice) {
                    $wordChoice->correct = 1;
                } else {
                    $wordChoice->correct = 0;
                }
                
                $wordChoice->save();
            }
            DB::commit();
        } catch (Exception $e) {
            log::error($e);
            DB::rollBack();
            return redirect()->back();
        }

        return redirect()->action('Admin\WordController@index');
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
            $word = Word::findOrFail($id);
            $word->answers()->delete();
            $word->wordChoices()->delete();
            $word->lessons()->detach();
            $word->delete();
            DB::commit();
        } catch (Exception $e) {
            log::error($e);
            DB::rollBack();
            return redirect()->back();
        }
    }
}
