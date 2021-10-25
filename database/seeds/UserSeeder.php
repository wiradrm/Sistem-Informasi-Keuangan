<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User([
            "username"      =>"gaspargarung",
            "password"  =>bcrypt('gaspar1234'),
            "hak_akses"      =>"1"
        ]);
        $user1->save();

        $user2 = new User([
            "username"      =>"thomasaquino",
            "password"  =>bcrypt('thomas1234'),
            "hak_akses"      =>"2"
        ]);
        $user2->save();
    }
}
