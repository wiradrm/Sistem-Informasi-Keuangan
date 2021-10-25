<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;

use App\AM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class AMExport implements FromView, ShouldAutoSize, WithEvents, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // EXPORT CUSTOM VIEW FUNCTION
    protected $view = 'admin.am.export';

    public function view(): View
    {
        if (Auth::user()->jabatan_id == 1 || Auth::user()->jabatan_id == 9) {
            return view($this->view, [
                'models' => AM::isNotDeleted()->orderby('created_at', 'DESC')->get(),
                'count' => count(AM::isNotDeleted()->orderby('created_at', 'DESC')->get())
            ]);
        } else {
            return view($this->view, [
                'models' => AM::isNotDeleted()->where('user_id', Auth::user()->id)->orderby('created_at', 'DESC')->get(),
                'count' => count(AM::isNotDeleted()->where('user_id', Auth::user()->id)->orderby('created_at', 'DESC')->get())
            ]);
        };
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                if (Auth::user()->jabatan_id == 1 || Auth::user()->jabatan_id == 9) {
                    $all = count(AM::isNotDeleted()->orderby('created_at', 'DESC')->get());
                } else {
                    $all = count(AM::isNotDeleted()->where('user_id', Auth::user()->id)->orderby('created_at', 'DESC')->get());
                };
                $total = $all + 1;
                $event->sheet->getDelegate()->getStyle('A1:F' . $total)->getFont()->setSize(12);
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
                $event->sheet->getStyle('A1:F' . $total)->applyFromArray($styleArray);
            },
        ];
    }

    public function columnFormats(): array
    {
        return [];
    }
}
