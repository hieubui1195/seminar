<?php

use Illuminate\Database\Seeder;
use App\Models\Seminar;

class SeminarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Seminar::class, 10)->create();
    }
}
