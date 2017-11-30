<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'slug'      => 'title',
                'value'     => 'Lorem',
                'is_custom' => 0
            ],
            [
                'slug'      => 'description',
                'value'     => 'Epsum',
                'is_custom' => 0
            ],
            [
                'slug'      => 'address',
                'value'     => 'Dolor',
                'is_custom' => 0
            ],
            [
                'slug'      => 'phone',
                'value'     => 'Sitamet',
                'is_custom' => 0
            ],
            [
                'slug'      => 'email',
                'value'     => 'info@lorem.com',
                'is_custom' => 0
            ],
            [
                'slug'      => 'postbox',
                'value'     => 'PO Box xxxx',
                'is_custom' => 0
            ],
            [
                'slug'      => 'facebook',
                'value'     => 'https://www.facebook.com',
                'is_custom' => 0
            ],
            [
                'slug'      => 'twitter',
                'value'     => 'https://www.twitter.com',
                'is_custom' => 0
            ],
            [
                'slug'      => 'google_plus',
                'value'     => 'https://www.google.com',
                'is_custom' => 0
            ],
            [
                'slug'      => 'logo',
                'value'     => '/img/logo.png',
                'is_custom' => 0
            ],
            [
                'slug'      => 'notification-emails',
                'value'     => 'admin@gyanodaya.edu.np',
                'is_custom' => 0
            ],
            [
                'slug'      => 'placeholder',
                'value'     => '/img/placeholder.jpg',
                'is_custom' => 0
            ],
            [
                'slug'      => 'homepage',
                'value'     => '',
                'is_custom' => 0
            ],
        ];

        Setting::insert($settings);
    }
}
