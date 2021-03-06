<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompaniesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(FavoriteTagTableSeeder::class);
    }
}
