<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $orders = Order::where('house_id', $id)->get();
        
        return view('framing.orders.index')->with(['house_id' => $id, 'orders' => $orders]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
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

       
        DB::beginTransaction();
        try {
  
          $data = array(
            'num_po' => $request->num_po,
            'description' => $request->description,
            'option' => $request->option,
            'date_order' => $request->date_order,
            'qty_po' => $request->qty_po,
            'unit_price' => $request->unit_price,
            'name_Superint' => $request->name_Superint,
            'phone_Superint' => $request->phone_Superint,
            'house_id' => $request->id
          );
  
          Order::create($data);
  
          DB::commit();
          return redirect('/orders/'.$id)->with(['success' => 'House successfully saved']);
  
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
    public function destroy($id, $house_id)
    {
        Order::destroy($id);
        $orders = Order::where('house_id', $house_id)->get();
        return view('framing.orders.index')->with(['house_id' => $id, 'orders' => $orders]);
    }
}
