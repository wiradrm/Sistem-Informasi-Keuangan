<?php

use Illuminate\Database\Seeder;
use App\StatusTransaksi;
class StatusTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status1 = new StatusTransaksi([
            "status_transaksi"    =>  "Belum Input",
            "keterangan"    =>  "",
        ]);
        $status1->save();

        $status2 = new StatusTransaksi([
            "status_transaksi"    =>  "In Process",
            "keterangan"    =>  "",
        ]);
        $status2->save();

        $status4 = new StatusTransaksi([
            "status_transaksi"    =>  "Completed",
            "keterangan"    =>  "",
        ]);
        $status4->save();

        $status5 = new StatusTransaksi([
            "status_transaksi"    =>  "Cancel",
            "keterangan"    =>  "",
        ]);
        $status5->save();

        $status6 = new StatusTransaksi([
            "status_transaksi"    =>  "Kendala",
            "keterangan"    =>  "",
        ]);
        $status6->save();

        $status7 = new StatusTransaksi([
            "status_transaksi"    =>  "Belum Visit",
            "keterangan"    =>  "",
        ]);
        $status7->save();

        $status8 = new StatusTransaksi([
            "status_transaksi"    =>  "Prospek",
            "keterangan"    =>  "",
        ]);
        $status8->save();

        $status9 = new StatusTransaksi([
            "status_transaksi"    =>  "On Hand",
            "keterangan"    =>  "",
        ]);
        $status9->save();
    }
}
