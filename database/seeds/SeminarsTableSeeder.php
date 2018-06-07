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
    	Schema::disableForeignKeyConstraints();
        
        DB::table('users')->truncate();

        factory(Seminar::class, 10)->create();

        Schema::enableForeignKeyConstraints();
    }
}
