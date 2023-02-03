<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {

        \DB:: table('users')->insert([
            'branch_id' => null, // 0 For admin
            'name' => 'Mulawan, Aubrey Mae A.',
            'age' => 23,
            'contact_no' => 9363572098,
            'street' => 'Zone 9, Amfana Village, Macanhan',
            'barangay' => 'Carmen',
            'city' => 'Cagayan de Oro City',
            'province' => 'Misamis Oriental',
            'zip_code' => '9000',
            'country' => 'Philippines',
            'birthday' => Carbon::parse('2000-12-21'),
            'date_started' => Carbon::parse('2020-08-29'),
            'date_ended' => null,
            'personal_email' => 'aubreymaemulawan@gmail.com',
            'user_type' => 'Admin',
            'status' => 'Active',
            'email' => 'admin',
            'password' => bcrypt('admin123'),
        ]);
    }
}
