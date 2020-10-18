<?php

use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('option')->delete();
        $option = array(
            array(
                'name'      => 'Inspire',
                'phone'      => '+65 8246 9048',
                'email'      => 'info@inspire.com',
                'logo'      =>  'logo.png',
                'favicon'      =>  'favicon.png',
                'company_name' => 'sinthusan',
                'company_web_url' => '#',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );
        DB::table('option')->insert( $option );

        Cache::forever('optionCache', \App\Option::first());
    }
}
