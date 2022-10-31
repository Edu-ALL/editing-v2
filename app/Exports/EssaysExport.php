<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EssaysExport implements FromArray, ShouldAutoSize, WithStyles, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $essays;

    public function __construct(array $essays)
    {
        $this->essays = $essays;   
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                foreach ($event->sheet->getColumnIterator('F') as $row) {
                    $row_count = 1;
                    foreach ($row->getCellIterator() as $cell) {
                        if ($cell->getValue() != "" && (str_contains($cell->getValue(), '://') || (str_contains($cell->getValue(), ':\\')))) {
                            $link = $cell->getvalue();
                            // $link = "https://editing.crm-allinedu.com/upload_files/program/essay/editors/Editing-Aaman-Essays-by-Alyssa(29-07-2020).docx";
                            $cell->setValue("Download");

                            $cell->setHyperlink(new Hyperlink($link));

                            // Upd: Link stying added
                            $event->sheet->getStyle($cell->getCoordinate())->applyFromArray([
                                'font' => [
                                    'color' => ['rgb' => '0000FF'],
                                    'underline' => 'single'
                                ]
                            ]);
                        }
                        $row_count++;
                    }
                }
            }
        ];
    }

    public function array(): array
    {
        return $this->essays;
    }
}
