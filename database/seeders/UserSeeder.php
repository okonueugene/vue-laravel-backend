<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
        $user1->name = 'Admin';
        $user1->email_address = 'admin@admin.com';
        $user1->password = Hash::make('12345678');

        $user1->save();

        $user2 = new User();
        $user2->name = 'Felix Ouma';
        $user2->email_address = 'felix@gmail.com';
        $user2->password = Hash::make('12345678');

        $user2->save();
    }
}
