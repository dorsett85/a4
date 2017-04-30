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
        'ticker' => 'LOL',
        'company_name' => 'Giggle',
        'stock_exchange' => 'NYSE',
        'short_description' => 'Google\' goofy cousin',
        'company_url' => 'www.giggle.com',
        'hq_state' => 'the internet',
        'sector' => 'smiles',
        'industry_category' => 'jokes',
        'industry_group' => 'comedy',
        'strategy' => 'buy',
        ]);
    }
}
