<?php

use Illuminate\Database\Seeder;
use App\Favorite;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Favorite::insert([
            'ticker' => 'BIIB',
            'company_name' => 'Biogen Inc',
            'stock_exchange' => 'NasdaqGS',
            'short_description' => 'Biogen, Inc. is a global biotechnology company, which focuses on discovering, developing, manufacturing and delivering therapies for neurological, autoimmune and hematologic disorders. Its products include AVONEX, PLEGRIDY, TECFIDERA, TYSABRI, and FAMPYRA for multiple sclerosis, ALPROLIX for hemophilia B and ELOCTATE for hemophilia A. The company also collaborates on the development and commercialization of RITUXAN for the treatment of non-Hodgkin\'s lymphoma, chronic lymphocytic leukemia and other conditions and share profits and losses for GAZYVA which is approved for the treatment of chronic lymphocytic leukemia. Biogen was founded by Phillip Allen Sharp in 1978 and is headquartered in Cambridge, MA. ',
            'company_url' => 'www.biogen.com',
            'hq_state' => 'Massachusetts ',
            'sector' => 'Healthcare',
            'industry_category' => 'Drugs ',
            'industry_group' => 'Biotechnology',
            'user_id' => 1,
        ]);
    }
}
