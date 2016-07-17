<?php

use Illuminate\Database\Seeder;

class OAuthClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            [
                'id' => 'appid01',
                'secret' => 'secret',
                'name' => 'App AngularJS',
                'created_at' =>  '17/07/2016',
                'updated_at' =>  '17/07/2016',
            ]
        ]);
    }
}
