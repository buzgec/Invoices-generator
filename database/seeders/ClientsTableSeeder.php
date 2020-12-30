<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([[
            'name' => 'Relja development',
            'vat_number' => '109683673',
            'id_number' => '64355180',
            'checking_account' => '275-0020222289688-58',
            'city' => 'Cacak',
            'address' => 'Trnava bb',
            'phone' => '381604520077',
            'email' => 'ivan2302@gmail.com',
            'web' => 'www.reljadjordjevic.rs'
        ],[
            'name' => 'Uspon Cacak',
            'vat_number' => '10941361',
            'id_number' => '09828015',
            'checking_account' => '265-3030310000899-21',
            'city' => 'Cacak',
            'address' => 'Gradska rupa bb',
            'phone' => '0658219482',
            'email' => 'vlada21@gmail.com',
            'web' => 'http://www.uspon-ca.rs'
        ]]);
    }
}
