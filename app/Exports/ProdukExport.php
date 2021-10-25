<?php

namespace App\Exports;

use App\Produk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProdukExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // EXPORT CUSTOM VIEW FUNCTION
    protected $view = 'admin.produk.export';

    public function view(): View
    {
        return view($this->view, [
            'models' => Produk::isNotDeleted()->orderby('created_at', 'DESC')->get(),
            'count' => count(Produk::isNotDeleted()->get())
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
              $all = count(Produk::isNotDeleted()->get());
              $total = $all + 1;
              $event->sheet->getDelegate()->getStyle('A1:A'.$total)->getFont()->setSize(12);
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
              $event->sheet->getStyle('A1:A'.$total)->applyFromArray($styleArray);
            },
        ];
    }
}
