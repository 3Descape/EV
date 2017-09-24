<?php

use Illuminate\Database\Seeder;
use App\Text;
class TextsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Text::create([
            'title' => 'Vorstand',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '1',
            'order' => '1',
        ]);

        Text::create([
            'title' => 'ElternvertreterInnen',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '1',
            'order' => '2',
        ]);

        Text::create([
            'title' => 'Mitgliedsbeitrag',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '1',
            'order' => '3',
        ]);

        Text::create([
            'title' => 'Statuten',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '1',
            'order' => '4',
        ]);


        Text::create([
            'title' => 'Was ist der SGA?',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '2',
            'order' => '1',
        ]);

        Text::create([
            'title' => 'Welche Entscheidungen obliegen dem SGA?',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '2',
            'order' => '2',
        ]);

        Text::create([
            'title' => 'Beratungsrolle',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '2',
            'order' => '3',
        ]);

        Text::create([
            'title' => 'Aktuelles',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '3',
            'order' => '1',
        ]);

        Text::create([
            'title' => 'AbsolventInnen',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '3',
            'order' => '2',
        ]);

        Text::create([
            'title' => 'Fun Club',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '3',
            'order' => '3',
        ]);

        Text::create([
            'title' => 'Gesetze und Versicherungen',
            'html' => '<b>test</b>',
            'markup' => '**test**',
            'category' => '3',
            'order' => '4',
        ]);

        Text::create([
            'title' => 'Impressum',
            'markup' => '
            Elternverein Weiz
            Andreas Hammerschmidt
            Offenburger Gasse 23
            8160 Weiz
            Telefon: 49 2845 / 936 82 38
            Telefax: 49 2845 / 936 82 39
            E-Mail: info@example-sports.de',
            'html' => 'Elternverein Weiz</br>Andreas Hammerschmidt</br>Offenburger Gasse 23</br>8160 Weiz</br>Telefon: 49 2845 / 936 82 38</br>Telefax: 49 2845 / 936 82 39</br>E-Mail: info@example-sports.de',
            'category' => '4',
            'order' => '1',
        ]);
    }
}
