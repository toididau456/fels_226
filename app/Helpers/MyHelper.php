<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\User;
use App\Models\Word;
use App\Models\lesson;
use App\Models\WordChoice;
use App\Models\Answer;

class MyHelper
{
    public static function selectCate()
    {
        $cateResult = Category::all();
        $arr_select = [];
        foreach ($cateResult as $v) {
            $arr_select[$v->id] = $v->name;
        }
        return $arr_select;
    }
    public static function wordLearned($userId, $typeCate = null)
    {
        $wordId = [];
        if ($typeCate) {
            $lessonID = User::find($userId)->lessons()->where('category_id', $typeCate)->get()->pluck('id');
        } else {
            $lessonID = User::find($userId)->lessons()->get()->pluck('id');
        }
        $answer = Answer::with('wordChoice')->whereIn('lesson_id', $lessonID)->get()->toArray();
        foreach ($answer as $kq) {
            if ($kq['word_choice']['correct']) {
                $wordId[] = $kq['word_choice']['word_id'];
            }
        }
        return array_unique($wordId);
    }
    public static function wordUnLearned($userId, $typeCate = null)
    {
        if ($typeCate) {
            $wordID = Category::find($typeCate)
                    ->words()
                    ->whereIn('id', '<>', self::wordLearned($userId, $typeCate))
                    ->get()->pluck('id');
        } else {
            $wordID = whereIn('id', '<>', self::wordLearned($userId, $typeCate))->get()->pluck('id');
        }
        return $wordId;
    }
    public static function profileAjax($id, $type = null)
    {
        echo "<script src=js/jquery.js></script>";
        switch ($type) {
            case '1':
                $user = User::whereIn('id', self::following($id))->get();
                echo "<h3>Following</h3>";
                break;

            case '2':
                $user = User::whereIn('id', self::follower($id))->get();
                echo "<h3>Follower</h3>";
                break;

            default:
                $user = User::all();
                 echo "<h3>User</h3>";
                break;
        }
        echo '<div class="row" id="list-friend">';
        foreach ($user as $value) {
            echo '<div id="user-box" class="col-md-4">';
                echo '<a href="http://localhost/Project-Framgia/fels_226/public/profile/'.$value->id.'">';
                    if ($value->avatar == 'default-avatar.png') {
                        echo '<img src=http://localhost/Project-Framgia/fels_226/public/image/'.$value->avatar.' alt="">';
                    } else {
                        echo '<img src=http://localhost/Project-Framgia/fels_226/public/upload/'.$value->avatar.' alt="">';
                    }
                echo '</a>';
                echo '<a href="javasript:void(0)">';
                    echo '<span>'.$value->name.'</span>';
                    if (User::checkFollowed($value->id)) {
                        echo '<button type="button" class="btn btn-info btn-md" id="'.$value->id.'">Follwing</button>';
                    } else {
                        echo '<button type="button" class="btn btn-danger btn-md" id="'.$value->id.'">Follow</button>';
                    }
                echo '</a>';
            echo "</div>";
        }
        echo "</div>";
    }
    public static function following($userId)
    {
        return User::find($userId)->following()->get()->pluck('id');
    }
    public static function follower($userId)
    {
        return User::find($userId)->followers()->get()->pluck('id');
    }
}
