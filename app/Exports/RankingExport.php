<?php

namespace App\Exports;

use App\User;
use App\AM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RankingExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // EXPORT CUSTOM VIEW FUNCTION
    protected $view = 'admin.ranking.export';

    public function view(): View
    {
        return view($this->view, [
            'models' => User::isNotDeleted()->where('jabatan_id', '!=', '1')->where('jabatan_id', '!=', '9')->withCount('getPoint')->orderBy('get_point_count', 'asc')->get(),
            'count' => count(User::isNotDeleted()->where('jabatan_id', '!=', '1')->where('jabatan_id', '!=', '9')->withCount('getPoint')->orderBy('get_point_count', 'asc')->get()),
            'prospek' => AM::isNotDeleted()->get()
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
              $all = count(User::isNotDeleted()->where('jabatan_id', '!=', '1')->where('jabatan_id', '!=', '9')->withCount('getPoint')->orderBy('get_point_count', 'asc')->get());
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
