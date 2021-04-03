<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use DB;
use App\Additional;
use App\Tool;
use App\Payment;
use App\House;

class PaymentController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'date' => ['required'],
            'amount' => ['required'],
            'type' => ['required'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($house_id)
    {
        $house = House::findOrFail($house_id);
       
        $payments = Payment::where('house_id', $house_id)
                ->orderBy('id', 'DESC')
                ->get();
        $totalpayment = $payments->sum('amount');

        $additional = Additional::where('house_id', $house_id)->sum('amount');
        $tool = Tool::where('house_id', $house_id)->sum('amount');

        $totalavailable = ($house->amount_assigned_subc + $additional) - $tool - $totalpayment;

        return view('framing.payments.index')->with(['house' => $house, 'payments' => $payments, 'totalavailable' => $totalavailable ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($house_id)
    {
        return view("framing.payments.create")->with(['house_id' => $house_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $house_id)
    {
        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
  
          $data = array(
            'date' => $request->date,
            'amount' => $request->amount,
            'type' => $request->type,
            'house_id' => $house_id
          );
  
          Payment::create($data);
  
          DB::commit();

          return redirect('/payments/'.$house_id)->with(['success' => 'Payment successfully saved']);

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
        $payment = Payment::findOrFail($id);
        
        return view("framing.payments.edit")->with(['house_id' => $house_id, 'payment' => $payment]);
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
        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
  
          $payment = Payment::find($id);
          $payment->date = $request->date;
          $payment->amount = $request->amount;
          $payment->type = $request->type;
          $payment->save();
  
          DB::commit();

          return redirect('/payments/'.$house_id)->with(['success' => 'Payment successfully edit']);

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

        Payment::destroy($id);

        return redirect('/payments/'.$house_id)->with(['success' => 'Payment successfully delete']);
    }
}
