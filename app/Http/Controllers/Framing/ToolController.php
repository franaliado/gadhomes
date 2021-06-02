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


    public function index($subcontractor_id)
    {
        $subcontractor = Subcontractor::findOrFail($subcontractor_id);
       
        $tools = Tool::where('subcontractor_id', $subcontractor_id)
                ->orderBy('id', 'DESC')
                ->get();
        $totaltools = $tools->sum('amount');

        return view('framing.tools.index')->with(['subcontractor' => $subcontractor, 'tools' => $tools, 'totaltools' => $totaltools ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subcontractor_id)
    {
        return view("framing.tools.create")->with(['subcontractor_id' => $subcontractor_id]);
    }



    public function store(Request $request, $subcontractor_id)
    {
        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
  
          $data = array(
            'description' => $request->description,
            'date' => $request->date,
            'amount' => $request->amount,
            'subcontractor_id' => $subcontractor_id
          );
  
          Tool::create($data);
  
          DB::commit();

          return redirect('/tools/'.$subcontractor_id)->with(['success' => 'Tools successfully saved']);

        }catch (\Exception $e) {
            DB::rollback();
	        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

 
    public function edit($id, $subcontractor_id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }

        $tool = Tool::findOrFail($id);
        
        return view("framing.tools.edit")->with(['subcontractor_id' => $subcontractor_id, 'tool' => $tool]);
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
  
          $tool = Tool::find($id);
          $tool->description = $request->description;
          $tool->date = $request->date;
          $tool->amount = $request->amount;
          $tool->save();
  
          DB::commit();

          return redirect('/tools/'.$subcontractor_id)->with(['success' => 'Tools successfully edit']);

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id, $subcontractor_id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }

        Tool::destroy($id);

        return redirect('/tools/'.$subcontractor_id)->with(['success' => 'Tools successfully delete']);
    }
}
