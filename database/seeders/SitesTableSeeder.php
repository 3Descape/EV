<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\SiteCategory;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    public function run()
    {
        $site_category = SiteCategory::whereName('Über uns')->first();

        Site::create([
            'title' => 'ElternvertreterInnen',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. <personen-liste kategorie="sga"></personen-liste>',
            'site_category_id' => $site_category->id,
            'order' => '2',
        ]);

        Site::create([
            'title' => 'Mitgliedsbeitrag',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'site_category_id' => $site_category->id,
            'order' => '3',
        ]);

        Site::create([
            'title' => 'Statuten',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'site_category_id' => $site_category->id,
            'order' => '4',
        ]);

        $site_category = SiteCategory::whereName('SGA')->first();

        Site::create([
            'title' => 'Was ist der SGA?',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'site_category_id' => $site_category->id,
            'order' => '1',
        ]);

        Site::create([
            'title' => 'Welche Entscheidungen obliegen dem SGA?',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'site_category_id' => $site_category->id,
            'order' => '2',
        ]);

        Site::create([
            'title' => 'Beratungsrolle',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'site_category_id' => $site_category->id,
            'order' => '3',
        ]);

        $site_category = SiteCategory::whereName('Information')->first();

        Site::create([
            'title' => 'Aktuelles',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'site_category_id' => $site_category->id,
            'order' => '1',
        ]);

        Site::create([
            'title' => 'AbsolventInnen',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'site_category_id' => $site_category->id,
            'order' => '2',
        ]);

        Site::create([
            'title' => 'Fun Club',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'site_category_id' => $site_category->id,
            'order' => '3',
        ]);

        Site::create([
            'title' => 'Gesetze und Versicherungen',
            'markup' => '**test**Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'site_category_id' => $site_category->id,
            'order' => '4',
        ]);

        $site_category = SiteCategory::whereName('Impressum')->first();

        Site::create([
                                    'title' => 'Impressum',
                                    'markup' => '<center>
                                    Elternverein Weiz
                                    Andreas Hammerschmidt
                                    Offenburger Gasse 23
                                    8160 Weiz
                                    Telefon: 49 2845 / 936 82 38
                                    Telefax: 49 2845 / 936 82 39
                                    E-Mail: info@example-sports.de
            </center>
            ',
            'site_category_id' => $site_category->id,
            'order' => '1',
        ]);
    }
}
