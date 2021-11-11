<?php

use Illuminate\Database\Seeder;
use App\Kelas;
class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas1 = new Kelas([
            "no_kelas"    => "1",
            "kelas"    => "Kelas 1",
            "wali"    => "YEREMIAS CENDANA",
        ]);
        $kelas1->save();

        $kelas2 = new Kelas([
            "no_kelas"    => "2",
            "kelas"    => "Kelas 2",
            "wali"    => "AGUSTINUS JEHALA",
        ]);
        $kelas2->save();


        $kelas3 = new Kelas([
            "no_kelas"    => "3",
            "kelas"    => "Kelas 3",
            "wali"    => "FRANSISKUS F. HADIA NATAL",
        ]);
        $kelas3->save();


        $kelas4 = new Kelas([
            "no_kelas"    => "4",
            "kelas"    => "Kelas 4",
            "wali"    => "EMILDA KARTINI",
        ]);
        $kelas4->save();


        $kelas5 = new Kelas([
            "no_kelas"    => "5",
            "kelas"    => "Kelas 5",
            "wali"    => "MARIA SUSANTI JUSMITA",
        ]);
        $kelas5->save();


        $kelas6 = new Kelas([
            "no_kelas"    => "6",
            "kelas"    => "Kelas 6",
            "wali"    => "YULIANA SAFRIBOL",
        ]);
        $kelas6->save();

    }
}
