<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
                'name' => 'owner1',
                'email' => 'a@a',
                'password' => Hash::make('kenta1023i'),
                'created_at' => '2021/01/01 11:11:11'    
            ],
            [
                'name' => 'owner2',
                'email' => 'b@b',
                'password' => Hash::make('kenta1023i'),
                'created_at' => '2021/01/01 11:11:11'    
            ],
            [
                'name' => 'owner3',
                'email' => 'c@c',
                'password' => Hash::make('kenta1023i'),
                'created_at' => '2021/01/01 11:11:11'    
            ],
            [
                'name' => 'owner4',
                'email' => 'd@d',
                'password' => Hash::make('kenta1023i'),
                'created_at' => '2021/01/01 11:11:11'    
            ],
            [
                'name' => 'owner5',
                'email' => 'e@e',
                'password' => Hash::make('kenta1023i'),
                'created_at' => '2021/01/01 11:11:11'    
            ],
            [
                'name' => 'owner6',
                'email' => 'f@f',
                'password' => Hash::make('kenta1023i'),
                'created_at' => '2021/01/01 11:11:11'    
            ],
        ]);
    }
}
