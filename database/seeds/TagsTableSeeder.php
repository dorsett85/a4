<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tags = ['bluechip', 'income', 'cyclical', 'non-cyclical', 'defensive', 'growth', 'speculative',
            'tech', 'high-risk', 'emerging', 'safety', 'seasonal', 'non-seasonal', 'bo derek'];

        foreach ($tags as $tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        }
    }
}
