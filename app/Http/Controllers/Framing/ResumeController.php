<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Subcontractor;
use App\Tool;
use App\Payment;
use PDF;

class ResumeController extends Controller
{
    public function index($subcontractor_id, $totalhouses) {
        $resume = Subcontractor::where('id', $subcontractor_id)
                    ->first();
        $tools = Tool::where('subcontractor_id', $subcontractor_id)
                    ->orderBy('date', 'ASC')
                    ->get();
        $payments = Payment::where('subcontractor_id', $subcontractor_id)
                    ->orderBy('date', 'ASC')
                    ->get();
     
        return view('framing.resume.index')->with(['resume' => $resume, 'tools' => $tools, 'payments' => $payments, 'totalhouses' => $totalhouses]);
    }
    public function resumePdf($subcontractor_id, $totalhouses) {
        $image = base64_encode(file_get_contents(public_path('/images/logos/GAD_Logo6.png')));
        $resume = Subcontractor::where('id', $subcontractor_id)
                    ->first();
        $tools = Tool::where('subcontractor_id', $subcontractor_id)
                    ->orderBy('date', 'ASC')
                    ->get();
        $payments = Payment::where('subcontractor_id', $subcontractor_id)
                    ->orderBy('date', 'ASC')
                    ->get();

        $pdf = PDF::loadView('framing.pdf.resume_pdf', ['resume'=>$resume, 'logo'=>$image, 'tools' => $tools, 'payments' => $payments, 'totalhouses' => $totalhouses]);
        return $pdf->download('resume.pdf');
    }
}
