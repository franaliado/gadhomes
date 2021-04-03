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

class ToolController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'description' => ['required', 'string', 'max:250'],
            'date' => ['required'],
            'amount' => ['required'],
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
       
        $tools = Tool::where('house_id', $house_id)
                ->orderBy('id', 'DESC')
                ->get();
        $totaltool = $tools->sum('amount');

        $additional = Additional::where('house_id', $house_id)->sum('amount');
        $payment = Payment::where('house_id', $house_id)->sum('amount');

        $totalavailable = ($house->amount_assigned_subc + $additional) - $totaltool - $payment;

        return view('framing.tools.index')->with(['house' => $house, 'tools' => $tools, 'totalavailable' => $totalavailable ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($house_id)
    {
        return view("framing.tools.create")->with(['house_id' => $house_id]);
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
            'description' => $request->description,
            'date' => $request->date,
            'amount' => $request->amount,
            'house_id' => $house_id
          );
  
          Tool::create($data);
  
          DB::commit();

          return redirect('/tools/'.$house_id)->with(['success' => 'Tools successfully saved']);

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
        $tool = Tool::findOrFail($id);
        
        return view("framing.tools.edit")->with(['house_id' => $house_id, 'tool' => $tool]);
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
  
          $tool = Tool::find($id);
          $tool->description = $request->description;
          $tool->date = $request->date;
          $tool->amount = $request->amount;
          $tool->save();
  
          DB::commit();

          return redirect('/tools/'.$house_id)->with(['success' => 'Tools successfully edit']);

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

        Tool::destroy($id);

        return redirect('/tools/'.$house_id)->with(['success' => 'Tools successfully delete']);
    }
}
