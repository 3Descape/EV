<?php

use Illuminate\Database\Seeder;
use App\Text;
use App\Menu;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Text::create([
        'title'=>'Über uns',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '1',
        'order' => '0'
      ]);
      Text::create([
        'title'=>'Vorstand',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '1',
        'order' => '1'
      ]);
      Text::create([
        'title'=>'ElternvertreterInnen',
        'text' => 'sdafdffdasdf',
        'category' => '1',
        'order' => '2'
      ]);
      Text::create([
        'title'=>'Mitgliedsbeitrag',
        'text' => '10euro',
        'category' => '1',
        'order' => '3'
      ]);
      Text::create([
        'title'=>'Was ist der SGA?',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '2',
        'order' => '0'
      ]);
      Text::create([
        'title'=>'Welche Entscheidung obliegen dem SGA?',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '2',
        'order' => '1'
      ]);
      Text::create([
        'title'=>'Beratungsrolle',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '2',
        'order' => '2'
      ]);
      Text::create([
        'title'=>'Aktuelles',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '3',
        'order' => '0'
      ]);
      Text::create([
        'title'=>'AbsolventInnen',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '3',
        'order' => '1'
      ]);
      Text::create([
        'title'=>'FUN Club',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '3',
        'order' => '2'
      ]);
      Text::create([
        'title'=>'Ferien und schulautonome Tage',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '3',
        'order' => '3'
      ]);
      Text::create([
        'title'=>'Gesetze und Versicherungen',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '3',
        'order' => '4'
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
