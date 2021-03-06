<?php

use Illuminate\Database\Seeder;
use App\Models\Participant;

class ParticipantsTableSeeder extends Seeder
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

        factory(Participant::class, 50)->create();

        Schema::enableForeignKeyConstraints();
    }
}
