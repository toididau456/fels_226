<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $cate = factory(\App\Models\Category::class, 3)
            ->create()
            ->each(function ($u) {
                $u->lessons()->save(factory(\App\Models\Lesson::class)->make());
                for ($i=0; $i < 10; $i++) {
                    $u->words()->save(factory(\App\Models\Word::class)->make());
                }
            });
        factory(App\Models\WordChoice::class, 10)->create();
    }
}
