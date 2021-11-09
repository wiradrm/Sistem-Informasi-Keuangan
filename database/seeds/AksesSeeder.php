<?php

use Illuminate\Database\Seeder;
use App\Akses;
class AksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $akses1 = new Akses([
            "akses"    => "Kepala Sekolah",
        ]);
        $akses1->save();

        $akses2 = new Akses([
            "akses"    => "Admin",
        ]);
        $akses2->save();
    }
}
