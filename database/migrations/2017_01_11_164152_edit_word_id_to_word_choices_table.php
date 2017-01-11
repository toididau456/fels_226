<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditWordIdToWordChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('word_choices', function (Blueprint $table) {
            $table->renameColumn('category_id', 'word_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('word_choices', function (Blueprint $table) {
            $table->renameColumn('word_id', 'category_id');
        });
    }
}
