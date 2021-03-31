<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\House;
use App\Additional;
use App\Tool;
use App\Payment;
use PDF;

class ResumeController extends Controller
{
    public function index($house_id) {
        $resume = House::select('subcontractors.name as subcontractorName', 'subcontractors.phone as subcontractorPhone', 'subcontractors.email as subcontractorEmail','community.name as communityName', 'houses.address as houseAddress', 'houses.lot as houseLot', 'houses.amount_assigned_subc as houseAmountAssigned')                    
                    ->leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
                    ->leftJoin('community', 'community.id', 'houses.community_id')
                    ->where('houses.id', $house_id)
                    ->first();
        $additional = Additional::where('house_id', $house_id)
                    ->orderBy('id', 'ASC')
                    ->get();
        $tools = Tool::where('house_id', $house_id)
                    ->orderBy('id', 'ASC')
                    ->get();
        $payments = Payment::where('house_id', $house_id)
                    ->orderBy('id', 'ASC')
                    ->get();
     
        return view('framing.resume.index')->with(['resume' => $resume, 'additional' => $additional, 'tools' => $tools, 'payments' => $payments, 'house_id' => $house_id]);
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
