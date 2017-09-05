<?php

use Illuminate\Database\Seeder;
use App\Holiday;
class HolidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Holiday::create([
            'name' => 'Weihnachtsferien',
            'date' => '24.12.2016 - 08.01.2017',
            'category' => 'ferien'
        ]);
        Holiday::create([
            'name' => 'Semesterferien',
            'date' => '18.02.2017 - 26.02.2017',
            'category' => 'ferien'
        ]);
        Holiday::create([
            'name' => 'Osterferien',
            'date' => '08.04.2017 - 18.04.2017',
            'category' => 'ferien'
        ]);
        Holiday::create([
            'name' => 'Pfingstferien',
            'date' => '03.06.2017 - 05.06.2017',
            'category' => 'ferien'
        ]);

        Holiday::create([
            'name' => 'Nationalfeiertag',
            'date' => '26.10.2016 (Mittwoch)',
            'category' => 'schulautonom'
        ]);
        Holiday::create([
            'name' => 'Allerheiligen',
            'date' => '01.11.2016 (Dienstag)',
            'category' => 'schulautonom'
        ]);
        Holiday::create([
            'name' => 'Allerseelen',
            'date' => '02.11.2016 (Mittwoch)',
            'category' => 'schulautonom'
        ]);
    }
}
