<?php

use Illuminate\Database\Seeder;
use App\Jabatan;
class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan1 = new Jabatan([
            "jabatan"    => "Inputer",
        ]);
        $jabatan1->save();

        $jabatan2 = new Jabatan([
            "jabatan"    => "Asman Business OBL",
        ]);
        $jabatan2->save();

        $jabatan3 = new Jabatan([
            "jabatan"    => "Asman Business Sales Engineer",
        ]);
        $jabatan3->save();

        $jabatan4 = new Jabatan([
            "jabatan"    => "Asman Business Quality & Delivery",
        ]);
        $jabatan4->save();

        $jabatan5 = new Jabatan([
            "jabatan"    => "Asman Business Teritory Sales",
        ]);
        $jabatan5->save();

        $jabatan6 = new Jabatan([
            "jabatan"    => "Account Manager",
        ]);
        $jabatan6->save();

        $jabatan7 = new Jabatan([
            "jabatan"    => "AM Pro",
        ]);
        $jabatan7->save();

        $jabatan8 = new Jabatan([
            "jabatan"    => "EOS",
        ]);
        $jabatan8->save();

        $jabatan9 = new Jabatan([
            "jabatan"    => "Manager",
        ]);
        $jabatan9->save();

        $jabatan10 = new Jabatan([
            "jabatan"    => "Sales pro",
        ]);
        $jabatan10->save();

        $jabatan11 = new Jabatan([
            "jabatan"    => "Ex Sales pro",
        ]);
        $jabatan11->save();
    }
}
