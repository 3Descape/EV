<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(EventsTableSeeder::class);
      User::create([
        'name' => 'Michael Lackner',
        'email' => 'miclack30@gmail.com',
        'password' => bcrypt('121212'),
      ]);
      Menu::create([
        'name' => 'Über uns',
        'order' => '0',
        'route' => 'über_uns',
        'content' => '<div class="col-md-10 col-sm-12 mx-auto sizing">
                  <h2 class="text-center">{{ $content->title}}</h2>
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                     {!! $content->text !!}
                    </div>
                  </div>
                </div>',
      ]);
      Menu::create([
        'name' => 'Veranstaltungen',
        'order' => '1',
        'route' => 'veranstaltungen',
      ]);
      Menu::create([
        'name' => 'SGA',
        'order' => '2',
        'route' => 'sga',
      ]);
      Menu::create([
        'name' => 'Informationen',
        'order' => '3',
        'route' => 'info',
      ]);
      Menu::create([
        'name' => 'Kontakt',
        'order' => '4',
        'route' => 'kontakt',
      ]);
      Menu::create([
        'name' => 'Impressum',
        'order' => '5',
        'route' => 'impressum',
      ]);
    }
}
