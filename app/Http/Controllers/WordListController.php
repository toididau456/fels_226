<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Word;

class WordListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idCategory = $request->idCategory ? $request->idCategory : 1;
        $wordLearned = Word::learned($idCategory, config('myApp.correct'));
       
        switch ($request->typeWord) {
            case '1':
                $words = $wordLearned;
                break;
            case '2':
                /*$words = Word::whereNotIn('words.id', $wordLearned->pluck('words.id'))->where('category_id', $idCategory);*/
                $words = Word::unlearned()->where('words.category_id', $request->idCategory);
                break;
            default:
                $words = Category::find($idCategory)->words();
                break;
        }

        return view('pages.wordlist', [
            'listCategories' =>  Category::pluck('name', 'id'),
            'words' => $words->paginate(config('common.number_pagination')),
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
