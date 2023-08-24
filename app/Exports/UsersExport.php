<?php

namespace App\Exports;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\User;
use App\Models\Attendance;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Course;
use App\Models\Tainfo;
use App\Models\StudentClass;
use App\Models\Teaching;
use Auth;

class UsersExport implements FromCollection, WithCustomStartCell, WithColumnWidths, WithHeadings, WithStyles, WithEvents, WithColumnFormatting, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        
        $user_id = Auth::user()->id;
        
        return  Attendance::select('created_at','attend_data','status','note')->where('user_id',$user_id)->get();
        /*$attendance = DB::table('attendances')
                            ->join('tainfoes', 'ta_id', '=', 'tainfoes.ta_id')
                            ->join('courses', 'course_id', '=', 'course.course_id')
                            ->join('classes', 'course_id', '=', 'classes.course_id')
                            ->join('teaching', 'class_id', '=', 'teaching.class_id')
                            ->select('attendances.created_at','teaching.start_time','teaching.duration')
                            ->where('user_id',$user_id)->get();*/
    }


    
    public function startCell(): string
    {
        return 'B2';
    }
    public function columnWidths(): array
    {
        return [
            'B' => 30,
            'C' => 45,
            'D' => 10,
            'E' => 30,
        
        ];
    }
    public function headings(): array
    {
        return [
            'วันที่ลงเวลา',
            'การเข้าปฏิบัติการสอน (Y=เข้าสอน N=ลา)',
            'สถานะ',
            'หมายเหตุ',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return 
        [   
            

            // Styling a specific cell by coordinate.
            'B2:E2' => ['font' => ['bold' => true]]
            
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('B:E')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('B2:E11')->applyFromArray([
                                'borders' => [
                                    'outline' => [
                                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                        'color' => ['argb' => '000000'],
                                    ],
                                ]
                ]);
   
            },

        ];
    }
    public function map($invoice): array
    {
        return [
            Date::dateTimeToExcel($invoice->created_at),
            $invoice->attend_data,
            $invoice->status,
            $invoice->note
        ];
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

}