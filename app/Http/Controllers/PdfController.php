<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    //Generate Pdf

    public function  generatePdf(){

      //use
    $members = Member::All();
   
    $pdf = Pdf::loadView('pdf.gegenerate_pdf', compact('members'));
    
    return $pdf->stream('users.pdf');      //A function to Preview a PDF
   // return $pdf->download();  //A function to download PDF

    }

    //A function to just view on browser a PDF
    public function preview()
        { 
            
            $members = Member::All();

            return Pdf::loadView('pdf.generate_pdf', compact('members'))
                ->stream('generated-file.pdf');
        }

        //A function to download a PDF
    public function download()
        {
             $members = Member::all();

            return Pdf::loadView('pdf.generate_pdf', compact('members'))
                ->download('generated-file.pdf');
        }

}
