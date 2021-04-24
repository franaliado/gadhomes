<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use DB;
use App\Expense;

class ExpenseController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'date' => 'required',
            'description' => ['string', 'max:250', 'nullable'],
            'amount' => ['required'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
   
        $expenses = Expense::where('user_id', $user_id)
                ->orderBy('id', 'DESC')
                ->get();

        return view('framing.expenses.index')->with(['expenses' => $expenses, 'user_id' => $user_id]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        return view("framing.expenses.create")->with(['user_id' => $user_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
  
            $data = array(
                'type_expense' => $request->type_expense,
                'date' => $request->date,
                'description' => $request->description,
                'type_pay' => $request->type_pay,
                'card' => $request->card,
                'amount' => $request->amount,
                'user_id' => $user_id
            );

            Expense::create($data);
  
            DB::commit();
  
            return redirect('/expenses/'.$user_id)->with(['success' => 'Expense successfully saved']);
  
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
    public function destroy($id, $user_id)
    {
        Expense::destroy($id);
        return redirect('/expenses/'.$user_id)->with(['success' => 'Expense successfully delete']);
    }
}
