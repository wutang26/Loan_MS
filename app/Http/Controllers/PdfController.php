<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    //Generate Pdf

    public function  generatePdf(){

      //use
    $students = Student::All();
   
    $pdf = Pdf::loadView('generate_pdf', compact('students'));
    
    return $pdf->stream('students.pdf');      //A function to Preview a PDF
   // return $pdf->download();  //A function to download PDF

    }

    //A function to just view on browser a PDF
    public function preview()
        {
            return Pdf::loadView('generate_pdf')
                ->stream('generated-file.pdf');
        }

        //A function to download a PDF
    public function download()
        {
            return Pdf::loadView('generate_pdf')
                ->download('generated-file.pdf');
        }

}
