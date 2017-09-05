<?php

use Illuminate\Database\Seeder;

class AnalythicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dates = factory(App\Analythic::class, 200)->create();
    }
}
