<?php

use Illuminate\Database\Seeder;
use App\Spp;
class SppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spp1 = new SPP([
            "kode_spp"    => "SPP16",
            "angkatan"    => "2016",
            "bulan"    => "November",
            "jumlah_bayar"    => "50000",
        ]);
        $spp1->save();

        $spp2 = new SPP([
            "kode_spp"    => "SPP17",
            "angkatan"    => "2017",
            "bulan"    => "November",
            "jumlah_bayar"    => "55000",
        ]);
        $spp2->save();


        $spp3 = new SPP([
            "kode_spp"    => "SPP18",
            "angkatan"    => "2018",
            "bulan"    => "November",
            "jumlah_bayar"    => "60000",
        ]);
        $spp3->save();


        $spp4 = new SPP([
            "kode_spp"    => "SPP19",
            "angkatan"    => "2019",
            "bulan"    => "November",
            "jumlah_bayar"    => "65000",
        ]);
        $spp4->save();


        $spp5 = new SPP([
            "kode_spp"    => "SPP20",
            "angkatan"    => "2020",
            "bulan"    => "November",
            "jumlah_bayar"    => "70000",
        ]);
        $spp5->save();


        $spp6 = new SPP([
            "kode_spp"    => "SPP21",
            "angkatan"    => "2021",
            "bulan"    => "November",
            "jumlah_bayar"    => "75000",
        ]);
        $spp6->save();

    }
}
