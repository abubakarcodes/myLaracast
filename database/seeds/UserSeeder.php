<?php

use Illuminate\Database\Seeder;
use App\User;
use App\models\Series;
use App\models\Lesson;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
        factory(Series::class, 100)->create();
        factory(Lesson::class, 400)->create();


    }
}
