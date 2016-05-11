<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
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
                'id' => 'app',
                'secret' => 'secret',
                'name' => 'App AngularJS',
                'created_at' =>  '03/02/2016',
                'updated_at' =>  '03/02/2016',
            ]
        ]);
    }
}
