<?php

use Illuminate\Database\Seeder;
use App\Transaksi;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trans1 = new Transaksi([
            "transaksi"     =>  "AO",
            "keterangan"    =>  "Pemasangan Baru",
        ]);
        $trans1->save();

        $trans2 = new Transaksi([
            "transaksi"     =>  "MO",
            "keterangan"    =>  "Upgrade",
        ]);
        $trans2->save();

        $trans3 = new Transaksi([
            "transaksi"     =>  "MO",
            "keterangan"    =>  "Downgrade",
        ]);
        $trans3->save();

        $trans4 = new Transaksi([
            "transaksi"     =>  "DO",
            "keterangan"    =>  "Cabut",
        ]);
        $trans4->save();

        $trans5 = new Transaksi([
            "transaksi"     =>  "SO",
            "keterangan"    =>  "Suspend",
        ]);
        $trans5->save();

        $trans6 = new Transaksi([
            "transaksi"     =>  "RO",
            "keterangan"    =>  "Buka Suspend",
        ]);
        $trans6->save();

        $trans7 = new Transaksi([
            "transaksi"     =>  "-",
            "keterangan"    =>  "Perpanjangan",
        ]);
        $trans7->save();

        $trans8 = new Transaksi([
            "transaksi"     =>  "MO",
            "keterangan"    =>  "Add Service",
        ]);
        $trans8->save();

        $trans9 = new Transaksi([
            "transaksi"     =>  "MO",
            "keterangan"    =>  "Cabut Service",
        ]);
        $trans9->save();

        $trans10 = new Transaksi([
            "transaksi"     =>  "MO",
            "keterangan"    =>  "Modify Price",
        ]);
        $trans10->save();
    }
}
