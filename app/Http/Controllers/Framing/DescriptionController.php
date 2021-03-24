<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use DB;
use App\Descriptionpo;
use App\Order;
use App\House;
use App\Invoice;

class DescriptionController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'description' => ['required', 'string', 'max:250'],
            'option' => ['string', 'max:100', 'nullable'],
            'qty_po' => ['required'],
            'unit_price' => ['required'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $house_id)
    {
        $orders = Order::findOrFail($id);
        $descriptionpos = Descriptionpo::where('order_id', $orders->id)
                ->orderBy('id', 'DESC')
                ->get();

        return view('framing.descriptionpo.index')->with(['house_id' => $house_id, 'orders' => $orders, 'descriptionpos' => $descriptionpos]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($order_id, $house_id)
    {
        return view("framing.descriptionpo.create")->with(['order_id' => $order_id, 'house_id' => $house_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $order_id, $house_id)
    {

        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
  
            $data = array(

                'description' => $request->description,
                'option' => $request->option,
                'qty_po' => $request->qty_po,
                'unit_price' => $request->unit_price,
                'order_id' => $order_id
            );

            $PO = Descriptionpo::create($data);  
            DB::commit();
          

            $orders = Order::findOrFail($order_id);
            $descriptionpos = Descriptionpo::where('order_id', $orders->id)->get();
            return view('framing.descriptionpo.index')->with(['orders' => $orders, 'house_id' => $house_id, 'descriptionpos' => $descriptionpos]); 

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
    public function edit($id, $order_id, $house_id)
    {
        $descriptionpo = Descriptionpo::findOrFail($id);
        
        return view("framing.descriptionpo.edit")->with(['descriptionpo' =>  $descriptionpo, 'order_id' => $order_id, 'house_id' => $house_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $order_id, $house_id)
    {

        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
  
          $descriptionpo = Descriptionpo::find($id);
          $descriptionpo->description = $request->description;
          $descriptionpo->option = $request->option;
          $descriptionpo->qty_po = $request->qty_po;
          $descriptionpo->unit_price = $request->unit_price;
          $descriptionpo->save();
  
          DB::commit();

          $orders = Order::findOrFail($order_id);
          $descriptionpos = Descriptionpo::where('order_id', $orders->id)->get();
          return view('framing.descriptionpo.index')->with(['orders' => $orders, 'house_id' => $house_id, 'descriptionpos' => $descriptionpos]); 

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
    public function destroy($id, $order_id, $house_id)
    {
        Descriptionpo::destroy($id);

        $orders = Order::findOrFail($order_id);
        $descriptionpos = Descriptionpo::where('order_id', $orders->id)->get();
        return view('framing.descriptionpo.index')->with(['orders' => $orders, 'house_id' => $house_id, 'descriptionpos' => $descriptionpos]);  
    }
}
