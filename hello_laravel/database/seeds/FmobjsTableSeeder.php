<?php

use Illuminate\Database\Seeder;
use App\Models\Fmobj;

class FmobjsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Fmobj::class, 15)->create();
    }
}
