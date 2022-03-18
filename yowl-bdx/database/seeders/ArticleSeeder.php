<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            [
                'url' => 'https://www.francetvinfo.fr/sante/maladie/coronavirus/vaccin/vaccin-contre-le-covid-19-face-a-l-afflux-de-demandes-les-creneaux-pour-la-dose-de-rappel-ne-sont-pas-encore-au-rendez-vous_4865531.html',
                'category_id' => 1,
                'description' => 'Vaccin contre le Covid-19',
                'created_at' => '2021-12-01 20:01:00',
                'user_id' => 3
            ],

            [
                'url' => 'https://www.lefigaro.fr/politique/comment-emmanuel-macron-s-est-finalement-converti-au-nucleaire-20211201',
                'category_id' => 2,
                'description' => 'la France sur la voie de l’atome',
                'created_at' => '2021-11-11 10:00:00',
                'user_id' => 5
            ],

            [
                'url' => 'https://www.liberation.fr/international/europe/dans-les-hautes-spheres-de-lunion-europeenne-des-commissaires-et-des-juges-a-lethique-en-toc-20211201_63AW5LPZPNE23NNCMADOXNSGEM/',
                'category_id' => 2,
                'description' => 'Conflits d’intérêts et trafics d’influence au sommet de l’UE',
                'created_at' => '2021-10-20 09:00:00',
                'user_id' => 6
            ],

        ]);
    }
}
