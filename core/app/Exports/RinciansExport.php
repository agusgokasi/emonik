<?php

namespace App\Exports;

use App\Rincian;
use App\Permohonan;
use Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use \Maatwebsite\Excel\Writer;
use \Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class RinciansExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStrictNullComparison, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function forId(int $id)
    {
        $this->id = $id;
        
        return $this;
    }

    public function headings(): array
    {
        return [
            '#',
            'Jenis Belanja',
            'Biaya Satuan',
            'Volume',
            'Satuan',
            'Biaya Usulan',
            'Biaya Realisasi',
            'Sisa Usulan',
            'Dibuat',
            'Diedit',
        ];
    }

    public function map($rincian): array
    {
        $key=0;
    	$this->results = [
        	++$key,
            $rincian->jenisbelanja,
            'Rp'.format_uang($rincian->biayasatuan),
            $rincian->volume,
            $rincian->satuan,
            'Rp'.format_uang($rincian->biayatotal),
            'Rp'.format_uang($rincian->biayaterpakai),
            'Rp'.format_uang($rincian->sisabiaya),
            with($rincian->created_at)->format('D, d-m-Y H:i:s'),
            with($rincian->updated_at)->format('D, d-m-Y H:i:s'),
        ];
        // dd($this->results);
        return $this->results;
    }


    public function query()
    {
    	$this->query = Rincian::query()->where('permohonan_id', $this->id);
        return $this->query;
    }

    public function registerEvents(): array
    {
        return [
			Writer::macro('setCreator', function (Writer $writer, string $creator) {
			    $writer->getDelegate()->getProperties()->setCreator($creator);
			}),
			Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
			    $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
			}),
			Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
			    $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
			}),
            BeforeExport::class  => function(BeforeExport $event) {
                $event->writer->setCreator(Auth::user()->name);
            },
            AfterSheet::class    => function(AfterSheet $event) {
                // last column as letter value (e.g., D)
	            $last_column = Coordinate::stringFromColumnIndex(count($this->results));
	            // calculate last row + 1 (total results + header rows + column headings row + new row)
	            $last_row = $this->results[0] +2 +2;
	            // set up a style array for cell formatting
	            $style_text_center = [
	                'alignment' => [
	                    'horizontal' => Alignment::HORIZONTAL_CENTER
	                ]
	            ];
	            $permohonan = Permohonan::where('id', $this->id)->first();
	            $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

	            // at row 1, insert 2 rows
	            $event->sheet->insertNewRowBefore(1, 2);

                $event->sheet->styleCells(
                    'A3:J'.($last_row-1),
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );

	            // merge cells for full-width
	            $event->sheet->mergeCells(sprintf('A1:%s1',$last_column));
	            $event->sheet->mergeCells(sprintf('A2:%s2',$last_column));
	            $event->sheet->mergeCells(sprintf('A%d:%s%d',$last_row,'C',$last_row));
	            $event->sheet->mergeCells(sprintf('D%d:%s%d',$last_row,'F',$last_row));
	            $event->sheet->mergeCells(sprintf('G%d:%s%d',$last_row,'H',$last_row));
	            // $event->sheet->mergeCells(sprintf('A%d:%s%d',$last_row,$last_column,$last_row));

	            // assign cell values
	            $event->sheet->setCellValue('A1','E-Monitoring');
	            $event->sheet->setCellValue('A2','Laporan Keuangan: '.$permohonan->nama);
	            $event->sheet->setCellValue(sprintf('A%d',$last_row),'Biaya Perencanaan: Rp'.format_uang($permohonan->totalbiaya));
	            $event->sheet->setCellValue(sprintf('D%d',$last_row),'Total Usulan: Rp'.format_uang($permohonan->biayarincian));
	            $event->sheet->setCellValue(sprintf('G%d',$last_row),'Total Realisasi: Rp'.format_uang($permohonan->danaterpakai));
	            $event->sheet->setCellValue(sprintf('I%d',$last_row),'Total Sisa Usulan: Rp'.format_uang($permohonan->sisadana));
	            $event->sheet->setCellValue(sprintf('J%d',$last_row),'Total Sisa Perencanaan: Rp'.format_uang($permohonan->sisarincian));

	            // assign cell styles
	            $event->sheet->getStyle('A1:A2')->applyFromArray($style_text_center);
	            // $event->sheet->getStyle(sprintf('A%d',$last_row))->applyFromArray($style_text_center);
	            // $event->sheet->getStyle(sprintf('D%d',$last_row))->applyFromArray($style_text_center);
	            // $event->sheet->getStyle(sprintf('D%d',$last_row))->applyFromArray($style_text_center);
	            // $event->sheet->getStyle(sprintf('G%d',$last_row))->applyFromArray($style_text_center);
	            // $event->sheet->getStyle(sprintf('I%d',$last_row))->applyFromArray($style_text_center);
	            // $event->sheet->getStyle(sprintf('J%d',$last_row))->applyFromArray($style_text_center);
            },
        ];
    }

    // public function collection()
    // {
    // 	// return $this->invoices->all();
    // 	$rincians = Rincian::where('permohonan_id', 1)->get();
    //     return $rincians;
    //     // return Rincian::where('permohonan_id', 'App\Permohonan->id')->get()
    // }
}
