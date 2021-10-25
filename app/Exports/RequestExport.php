<?php

namespace App\Exports;
use Illuminate\Support\Facades\Auth;

use App\RequestOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class RequestExport implements FromView, ShouldAutoSize, WithEvents, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // EXPORT CUSTOM VIEW FUNCTION
    protected $view = 'admin.request.export';

    public function view(): View
    {
        return view($this->view, [
            'models' => RequestOrder::isNotDeleted()->where('user_id', Auth::user()->id)->orderby('created_at', 'DESC')->get(),
            'count' => count(RequestOrder::isNotDeleted()->where('user_id', Auth::user()->id)->orderby('created_at', 'DESC')->get())
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
              $all = count(RequestOrder::isNotDeleted()->where('user_id', Auth::user()->id)->orderby('created_at', 'DESC')->get());
              $total = $all + 1;
              $event->sheet->getDelegate()->getStyle('A1:E'.$total)->getFont()->setSize(12);
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
              $event->sheet->getStyle('A1:E'.$total)->applyFromArray($styleArray);
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
        ];
    }
}