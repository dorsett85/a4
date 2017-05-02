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
        'ticker' => 'TEST',
        'company_name' => 'Test Company',
        'stock_exchange' => 'someStockExchange',
        'short_description' => 'Test company to seed favorites table',
        'company_url' => 'N/A',
        'hq_state' => 'The cloud',
        'sector' => 'Technology',
        'industry_category' => 'Coding',
        'industry_group' => 'Laravel',
        'strategy' => 'buy',
        ]);
    }
}
