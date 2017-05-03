<?php

use Illuminate\Database\Seeder;
use App\Favorite;
use App\Tag;

class FavoriteTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favorite = [
            'Test Company' => ['bluechip', 'bo derek']
        ];

        foreach ($favorite as $name => $tags) {
            $company = Favorite::where('company_name', 'like', $name)->first();

            foreach ($tags as $tagName) {
                $tag = Tag::where('name', 'like', $tagName)->first();
                $company->tags('name');
                $company->tags()->save($tag);
            }
        }
    }
}
