<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use DB;
use App\Additional;

class AdditionalController extends Controller
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
        $additional = Additional::where('house_id', $house_id)
                ->orderBy('id', 'DESC')
                ->get();

        return view('framing.additional.index')->with(['house_id' => $house_id, 'additional' => $additional ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($house_id)
    {
        return view("framing.additional.create")->with(['house_id' => $house_id]);
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
  
          Additional::create($data);
  
          DB::commit();

          $additional = Additional::where('house_id', $house_id)
          ->orderBy('id', 'DESC')
          ->get();

          return view('framing.additional.index')->with(['house_id' => $house_id, 'additional' => $additional ]); 
  
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
        $additional = Additional::findOrFail($id);
        
        return view("framing.additional.edit")->with(['house_id' => $house_id, 'additional' => $additional]);
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
  
          $additional = Additional::find($id);
          $additional->description = $request->description;
          $additional->date = $request->date;
          $additional->amount = $request->amount;
          $additional->save();
  
          DB::commit();

          $additional = Additional::where('house_id', $house_id)
          ->orderBy('id', 'DESC')
          ->get();

          return view('framing.additional.index')->with(['house_id' => $house_id, 'additional' => $additional ]); 
  
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

        Additional::destroy($id);

        $additional = Additional::where('house_id', $house_id)
                ->orderBy('id', 'DESC')
                ->get();

        return view('framing.additional.index')->with(['house_id' => $house_id, 'additional' => $additional ]); 
    }
}
