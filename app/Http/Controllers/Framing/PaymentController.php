<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use DB;
use App\Additional;
use App\Tool;
use App\Payment;
use App\Subcontractor;

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
    public function index($subcontractor_id)
    {
        $subcontractor = Subcontractor::findOrFail($subcontractor_id);
       
        $payments = Payment::where('subcontractor_id', $subcontractor_id)
                ->orderBy('id', 'DESC')
                ->get();
        $totalpayments = $payments->sum('amount');

        return view('framing.payments.index')->with(['subcontractor' => $subcontractor, 'payments' => $payments, 'totalpayments' => $totalpayments ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subcontractor_id)
    {
        return view("framing.payments.create")->with(['subcontractor_id' => $subcontractor_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $subcontractor_id)
    {
        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
  
          $data = array(
            'date' => $request->date,
            'amount' => $request->amount,
            'type' => $request->type,
            'subcontractor_id' => $subcontractor_id
          );
  
          Payment::create($data);
  
          DB::commit();

          return redirect('/payments/'.$subcontractor_id)->with(['success' => 'Payment successfully saved']);

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
    public function edit($id, $subcontractor_id)
    {
        $payment = Payment::findOrFail($id);
        
        return view("framing.payments.edit")->with(['subcontractor_id' => $subcontractor_id, 'payment' => $payment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $subcontractor_id)
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

          return redirect('/payments/'.$subcontractor_id)->with(['success' => 'Payment successfully edit']);

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
    public function destroy($id, $subcontractor_id)
    {

        Payment::destroy($id);

        return redirect('/payments/'.$subcontractor_id)->with(['success' => 'Payment successfully delete']);
    }
}
