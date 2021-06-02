<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Auth;

use DB;
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


    public function index($subcontractor_id, $user_id)
    {
        $subcontractor = Subcontractor::findOrFail($subcontractor_id);
       
        $payments = Payment::where('subcontractor_id', $subcontractor_id)
                ->where('user_id', $user_id)
                ->orderBy('id', 'DESC')
                ->get();
        $totalpayments = $payments->sum('amount');

        return view('framing.payments.index')->with(['subcontractor' => $subcontractor, 'payments' => $payments, 'totalpayments' => $totalpayments, 'user_id' => $user_id]); 
    }



    public function create($subcontractor_id, $user_id)
    {
        return view("framing.payments.create")->with(['subcontractor_id' => $subcontractor_id,'user_id' => $user_id]);
    }


    public function store(Request $request, $subcontractor_id, $user_id)
    {
        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
  
          $data = array(
            'date' => $request->date,
            'amount' => $request->amount,
            'type' => $request->type,
            'subcontractor_id' => $subcontractor_id,
            'user_id' => $user_id
          );
  
          Payment::create($data);
  
          DB::commit();

          return redirect('/payments/'.$subcontractor_id.'/'.$user_id)->with(['success' => 'Payment successfully saved']);

        }catch (\Exception $e) {
            DB::rollback();
	        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

 
    public function edit($id, $subcontractor_id, $user_id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }

        $payment = Payment::findOrFail($id);
        
        return view("framing.payments.edit")->with(['subcontractor_id' => $subcontractor_id, 'payment' => $payment, 'user_id' => $user_id]);
    }


    public function update(Request $request, $id, $subcontractor_id, $user_id)
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

          return redirect('/payments/'.$subcontractor_id.'/'.$user_id)->with(['success' => 'Payment successfully edit']);

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id, $subcontractor_id, $user_id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }
        
        Payment::destroy($id);

        return redirect('/payments/'.$subcontractor_id.'/'.$user_id)->with(['success' => 'Payment successfully delete']);
    }
}
