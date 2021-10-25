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
            "nama_user"      =>"Dian Larasati",
            "username"      =>"dianlarasati",
            "email"     =>"dianlarasati@gmail.com",
            "phone"     =>"+6281234567890",
            "nik"           => 1234567890,
            "jabatan_id"    => 1,
            "password"  =>bcrypt('dian12345'),
        ]);
        $user1->save();

        $user2 = new User([
            "nama_user"      =>"Bagus Pramajaya",
            "username"      =>"bagus",
            "email"     =>"bagus@gmail.com",
            "phone"     =>"+6281234567890",
            "nik"           => 4567890123,
            "jabatan_id"    => 2,
            "password"  =>bcrypt('bagus12345'),
        ]);
        $user2->save();
    }
}
