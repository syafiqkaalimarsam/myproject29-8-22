<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $user = [
         [
            'username' => 'admin',
            'name' => 'ini adalah admin',
            'email' => 'admin@gmail.com',
            'level' => 'admin',
            'password' => bcrypt('admin123')
         ],
         [
            'username' => 'kasir',
            'name' => 'ini adalah kasir',
            'email' => 'kasir@gmail.com',
            'level' => 'kasir',
            'password' => bcrypt('kasir123')
         ],
         [
            'username' => 'manager',
            'name' => 'ini adalah manager',
            'email' => 'manager@gmail.com',
            'level' => 'manager',
            'password' => bcrypt('manager123')
         ]        
         ];
         foreach ($user as $key => $value) {
            User::create($value);
         }
    }
}
