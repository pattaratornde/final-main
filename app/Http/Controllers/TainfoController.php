<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tainfo;
use App\Models\TaCourse;
use App\Models\TA;
use App\Models\User;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Attendance;
use App\Models\ClassTypeAttendance;
use App\Models\Teaching;
use DateTime;

use Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\DB;
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



class TainfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $tainfo = TaCourse::where('ta_id',$user_id)->get();
        return view('layouts.student.index',compact('tainfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ta_id)
    {
        $tadetail = TaCourse::findOrFail($ta_id);
        $teaching_id = [];
        foreach ($tadetail->course->classes as $c){

            foreach($c->teaching as $t){
                $teaching_id[] = $t->teaching_id;

            }

        }
    
         $monthlyData = Teaching::whereIn('teaching_id',$teaching_id)->selectRaw('MONTH(start_time) as month')
             ->groupBy(DB::raw('MONTH(start_time)'))
             ->orderBy(DB::raw('MONTH(start_time)'), 'asc')
             ->get();
        //dd($monthlyData);
        return view('layouts.student.detail',compact('tadetail','monthlyData'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function export($id) 
    {   
        $ta_course = TaCourse::where('id',$id)->get()->first();
        //dd($ta_course);
        $templatePath = public_path('template.xlsx');
        $spreadsheet = IOFactory::load($templatePath);
    
        // Get the active sheet
        $worksheet = $spreadsheet->getActiveSheet();
    
        // Fetch data from the database (assuming you have a 'users' table)
        $user_id = Auth::user()->id;
        $attend = Attendance::where('ta_id',$ta_course->ta_id)->get();

        //dd($users);

        // Set cell values in the template based on the data from the database
        $row = 12; // Start adding data from the second row (adjust as needed)
        $row_head = 5;
        $row_teacher = 6;
        $row_student = 7;
       

        foreach ($ta_course->course->classes as $c){
            
            foreach ($c->teaching()->whereMonth('start_time', request('m','1'))->get() as $t) {
                $att = $t->attendanceTa()->where('ta_id',$ta_course->ta_id)->get()->first();
                if($att != null){

                     $time = $t->start_time;
                     $dateTime = new DateTime($time);
                     $formattedDate = $dateTime->format('d/m/Y');
                     $formattedTime = $dateTime->format('H:i');

                     $worksheet->setCellValue('A' . $row, $formattedDate);
                     $worksheet->setCellValue('B' . $row, $formattedTime);
                     $worksheet->setCellValue('B' . $row_head, $t->class->course->subject->name_en);
                     $worksheet->setCellValue('C' . $row_head, $t->class->course->subject->name_th);
                     $worksheet->setCellValue('G' . $row_head, $t->class->course->subject->credit);
                     $worksheet->setCellValue('B' . $row_teacher, $t->class->course->teacher->name );
                     $worksheet->setCellValue('G' . $row_student, $t->class->major->name_th );
                     $worksheet->setCellValue('C' . $row, $t->class->major->name_th);
                     $worksheet->setCellValue('F' . $row, $att->note);
                     if($t->class_type == 'C') {
                         $worksheet->setCellValue('D' . $row, $t->class_type);

                     }
                     else{
                         $worksheet->setCellValue('E' . $row, $t->class_type);
                     }

                }
                // Increment row counter for the next iteration
                $row++;
            
        }

        $worksheet->setCellValue('B' . $row_student, $ta_course->ta->name);
        $worksheet->setCellValue('E' . $row_student, $ta_course->ta->student_id);
        
  
        }
        
    
        // Save the updated file with a new name
        $outputFile = public_path('filled_template'.$id.'.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($outputFile);
        
        return response()->download($outputFile, 'filled_template'.$id.'.xlsx');
    }

    public function exportattendace($id) 
    {
        $ta_course = TaCourse::where('id',$id)->get()->first();
        $templatePath = public_path('template.xlsx');
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active sheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Fetch data from the database (assuming you have a 'users' table)
        $user_id = Auth::user()->id;
        $attend = Attendance::where('ta_id',$ta_course->ta_id)->get();
        $classattend = DB::table('class_type_attendances')->get();

        $row = 12; // Start adding data from the second row (adjust as needed)
        $row_head = 5;
        $row_teacher = 6;
        $row_student = 7;

        foreach ($classattend as $ca) {
            
            $minutes = $ca->duration;
            $hours = floor($minutes / 60); // จำนวนชั่วโมง
            $remainingMinutes = $minutes % 60; // นาทีที่เหลือ
            // Set data in each cell
            $worksheet->setCellValue('A' . $row, $ca->start_work);
            $worksheet->setCellValue('B' . $row, $hours . 'ชั่วโมง' . $remainingMinutes . 'นาที' ) ;
            $worksheet->setCellValue('F' . $row, $ca->aact_detail);

            // Increment row counter for the next iteration
            $row++;

        }
    
        foreach ($ta_course->course->classes as $c){

            foreach ($c->teaching as $t) {
            
                // Set data in each cell

                $worksheet->setCellValue('B' . $row_head, $t->class->course->subject->name_en);
                $worksheet->setCellValue('C' . $row_head, $t->class->course->subject->name_th);
                $worksheet->setCellValue('G' . $row_head, $t->class->course->subject->credit);
                $worksheet->setCellValue('B' . $row_teacher, $t->class->course->teacher->name );
                $worksheet->setCellValue('G' . $row_student, $t->class->major->name_th );
                //$worksheet->setCellValue('C' . $row, $t->class->major->name_th);
                //$worksheet->setCellValue('F' . $row, $t->attendance->note);

        
                // Increment row counter for the next iteration
                $row++;
            
        }
        $worksheet->setCellValue('B' . $row_student, $ta_course->ta->name);
        $worksheet->setCellValue('E' . $row_student, $ta_course->ta->student_id);
        
  
        }

        // Save the updated file with a new name
        $outputFile = public_path('filled_template.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($outputFile);

        return response()->download($outputFile, 'เอกสารเข้าสอนเพิ่มเติม.xlsx');
    }

    public function monthsep()
    {

        $templatePath = public_path('template.xlsx');
        $spreadsheet = IOFactory::load($templatePath);
    
        // Get the active sheet
        $worksheet = $spreadsheet->getActiveSheet();
        $user_id = Auth::user()->id;
        $tainfo = TaCourse::where('ta_id',$user_id)->get();
        $users = ClassTypeAttendance::orderBy('start_work')->get()->groupBy(function($tainfo) {
            return $tainfo->timezone;
        });

        foreach($users as $timezone => $userList) {

                foreach($userList as $user) {

                }

        }
        
        // Save the updated file with a new name
        $outputFile = public_path('filled_template.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($outputFile);
        return response()->download($outputFile, 'เอกสารสรุปการเข้าสอน.xlsx');
    }
}