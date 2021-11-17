<?php

namespace App\Exports;
use DB;
use App\Spp;
use App\Bayar;

use App\Pengeluaran;
use App\Pemasukan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class JurnalExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // EXPORT CUSTOM VIEW FUNCTION
    protected $view = 'admin.jurnal.export';

    public function view(): View
    {
        $total_masuk = Pemasukan::isNotDeleted()->count();
        $total_keluar = Pengeluaran::isNotDeleted()->count();
        $total_bayar = Bayar::isNotDeleted()->where("status_transaksi", 1)->count();

        $jum_keluar = DB::table("tb_pengeluaran")->get()->sum("jumlah");
        $jum_masuk = DB::table("tb_pemasukan")->get()->sum("jumlah");
        $jum_spp = Bayar::isNotDeleted()->where("status_transaksi", 1)->get()->sum("jumlah");

        $total = $jum_spp+$jum_masuk+$jum_keluar;

        $jum = $total_bayar+$total_keluar+$total_masuk;

        return view($this->view, [
            'pemasukan' => Pemasukan::isNotDeleted()->get(),
            'pengeluaran' => Pengeluaran::isNotDeleted()->get(),
            'bayar' => Bayar::isNotDeleted()->where("status_transaksi", 1)->get(),
            'total' => DB::table("tb_pengeluaran")->get()->sum("jumlah")
                        +DB::table("tb_pemasukan")->get()->sum("jumlah")+
                        Bayar::isNotDeleted()->where("status_transaksi", 1)->get()->sum("jumlah"),
        ]);
    }

    public function registerEvents(): array
    {
        

         
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $total_masuk = Pemasukan::isNotDeleted()->count();
        $total_keluar = Pengeluaran::isNotDeleted()->count();
        $total_bayar = Bayar::isNotDeleted()->where("status_transaksi", 1)->count();

        $jumlah_data = $total_bayar+$total_keluar+$total_masuk;
              $all = $jumlah_data;
              $total_sheet = $all + 2 + ($jumlah_data*2);
              $event->sheet->getDelegate()->getStyle('A1:E'.$total_sheet)->getFont()->setSize(12);
              $styleArray = [
                  'borders' => [
                      'allBorders' => [
                          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                          'color' => ['rgb' => '#000000'],
                      ],
                  ],
                  'alignment' => [
                      'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                  ],
              ];
              $event->sheet->getStyle('A1:E'.$total_sheet)->applyFromArray($styleArray);
            },
        ];
    }
}
