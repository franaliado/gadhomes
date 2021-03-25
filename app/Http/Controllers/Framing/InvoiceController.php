<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Invoice;
use App\Order;
use App\Descriptionpo;
use PDF;

class InvoiceController extends Controller
{
    public function index($id, $house_id) {
        $invoice = Order::select('orders.*', 'invoices.id as idInvoice', 'invoices.num_invoice', 'invoices.created_at', 'community.name as communityName', 'houses.address as houseAddress', 'houses.lot as houseLot')                    
                    ->leftJoin('invoices', 'invoices.order_id', 'orders.id')
                    ->leftJoin('houses', 'houses.id', 'orders.house_id')
                    ->leftJoin('community', 'community.id', 'houses.community_id')
                    ->where('invoices.id', $id)
                    ->first();
        $descriptionpos = Descriptionpo::where('order_id', $invoice->id)
                    ->orderBy('id', 'ASC')
                    ->get();
        //dd($descriptionpos->toArray());
        //dd($invoice->toArray());
        
        return view('framing.invoices.index')->with(['invoice' => $invoice, 'house_id' => $house_id, 'descriptions' => $descriptionpos]);
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
