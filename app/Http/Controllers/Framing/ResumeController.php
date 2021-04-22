<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
                    ->orderBy('id', 'ASC')
                    ->get();
        $payments = Payment::where('subcontractor_id', $subcontractor_id)
                    ->orderBy('id', 'ASC')
                    ->get();
     
        return view('framing.resume.index')->with(['resume' => $resume, 'tools' => $tools, 'payments' => $payments, 'totalhouses' => $totalhouses]);
    }
    public function resumePdf($subcontractor_id, $totalhouses) {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));
        $resume = Subcontractor::where('id', $subcontractor_id)
                    ->first();
        $tools = Tool::where('subcontractor_id', $subcontractor_id)
                    ->orderBy('id', 'ASC')
                    ->get();
        $payments = Payment::where('subcontractor_id', $subcontractor_id)
                    ->orderBy('id', 'ASC')
                    ->get();

        $pdf = PDF::loadView('framing.pdf.resume', ['resume'=>$resume, 'logo'=>$image, 'tools' => $tools, 'payments' => $payments, 'totalhouses' => $totalhouses]);
        return $pdf->download('resume.pdf');
    }
}
