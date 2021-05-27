<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\Validator;

use DB;
use App\Order;
use App\House;
use App\Invoice;

class OrderController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'num_po' => ['required', 'integer', 'unique:orders'],
            'date_order' => ['required'],
            'name_Superint' => ['required', 'string', 'max:50'],
            'phone_Superint' => ['required', 'string', 'max:15'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $orders = Order::select('orders.*', 'invoices.id as idInvoice')->where('house_id', $id)->leftJoin('invoices', 'invoices.order_id', 'orders.id')->get();
        $house = House::findOrFail($id);

        return view('framing.orders.index')->with(['house' => $house, 'orders' => $orders]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }

        return view("framing.orders.create")->with(['house_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
 
            $data = array(
                'num_po' => $request->num_po,
                'date_order' => $request->date_order,
                'name_Superint' => $request->name_Superint,
                'phone_Superint' => $request->phone_Superint,
                'house_id' => $id
            );

            $PO = Order::create($data);  
            DB::commit();

             // Last invoice
            $ince = Invoice::select('num_invoice')->orderBy('id', 'DESC')->first();
            $num_invoice = $ince->num_invoice + 1;
            // Invoice
            $data_invoice = array(
                'num_invoice' => $num_invoice,
                'order_id' => $PO->id
            );

            Invoice::create($data_invoice);
            DB::commit();
            
            return redirect('/orders/'.$id)->with(['success' => 'Order successfully saved']);

        }catch (\Exception $e) {
            DB::rollback();
	        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $house_id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }

        $order = Order::findOrFail($id);
        
        return view("framing.orders.edit")->with(['house_id' => $house_id, 'order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $house_id)
    {

        $this->validate($request, [
            'num_po' => ['required', 'integer', 'unique:orders,num_po,'. $id],
            'date_order' => ['required'],
            'name_Superint' => ['required', 'string', 'max:50'],
            'phone_Superint' => ['required', 'string', 'max:15'],
        ]);

        DB::beginTransaction();
        try {
  
          $order = Order::find($id);
          $order->num_po = $request->num_po;
          $order->date_order = $request->date_order;
          $order->name_Superint = $request->name_Superint;
          $order->phone_Superint = $request->phone_Superint;
          $order->save();
  
          DB::commit();

          return redirect('/orders/'.$house_id)->with(['success' => 'Order successfully edit']);

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $house_id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }
        
        Order::destroy($id);

        $orders = Order::where('house_id', $house_id)->get();
        $house = House::findOrFail($house_id);
        
        return view('framing.orders.index')->with(['house' => $house, 'orders' => $orders]); 
    }
}
