<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function download($filename)
{
    $file_path = storage_path('app/public/student_files/' . $filename);
    return response()->download($file_path);
}

}

