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
    public function index($subcontractor_id, $total) {
        $resume = Subcontractor::where('id', $subcontractor_id)
                    ->first();
        $tools = Tool::where('subcontractor_id', $subcontractor_id)
                    ->orderBy('id', 'ASC')
                    ->get();
        $payments = Payment::where('subcontractor_id', $subcontractor_id)
                    ->orderBy('id', 'ASC')
                    ->get();
     
        return view('framing.resume.index')->with(['resume' => $resume, 'tools' => $tools, 'payments' => $payments, 'total' => $total]);
    }
    public function invoicePdf($id) {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));
        $invoice = Order::select('orders.*', 'invoices.id as idInvoice', 'invoices.num_invoice', 'invoices.created_at', 'community.name as communityName', 'houses.address as houseAddress', 'houses.lot as houseLot')                    
                    ->leftJoin('invoices', 'invoices.order_id', 'orders.id')
                    ->leftJoin('houses', 'houses.id', 'orders.house_id')
                    ->leftJoin('community', 'community.id', 'houses.community_id')
                    ->where('invoices.id', $id)
                    ->first();
        $descriptionpos = Descriptionpo::where('order_id', $invoice->id)
                    ->orderBy('id', 'ASC')
                    ->get();
        //dd($invoice);
        //return view('framing.pdf.invoice')->with(['invoice'=>$invoice, 'logo'=>$image]);
        $pdf = PDF::loadView('framing.pdf.invoice', ['invoice'=>$invoice, 'logo'=>$image, 'descriptions' => $descriptionpos]);
        return $pdf->download('invoice.pdf');
    }
}
