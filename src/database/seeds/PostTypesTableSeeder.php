<?php

use Featherwebs\Mari\Models\PostType;
use Illuminate\Database\Seeder;

class PostTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $postTypes = [
            [
                'title' => 'Event',
                'slug'  => 'event'
            ],
            [
                'title' => 'News',
                'slug'  => 'news'
            ]
        ];

        PostType::insert($postTypes);
    }
}
