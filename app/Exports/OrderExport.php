<?php

namespace App\Exports;

use App\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OrderExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // EXPORT CUSTOM VIEW FUNCTION
    protected $view = 'admin.order.export';

    public function view(): View
    {
        return view($this->view, [
            'models' => Order::orderby('created_at', 'DESC')->get(),
            'count' => count(Order::all())
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
              $all = count(Order::all());
              $total = $all + 1;
              $event->sheet->getDelegate()->getStyle('A1:F'.$total)->getFont()->setSize(12);
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
              $event->sheet->getStyle('A1:F'.$total)->applyFromArray($styleArray);
            },
        ];
    }
}
