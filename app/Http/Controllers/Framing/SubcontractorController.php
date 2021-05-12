<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Auth;

use DB;
use App\Subcontractor;

class SubcontractorController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:50', 'unique:subcontractors,name,'],
            'phone' => ['required', 'string', 'max:15', 'unique:subcontractors'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:subcontractors'],
        ]);
    }

    public function index(Request $request)
    {
        $query = trim($request->get('search'));

        $subcontractors = Subcontractor::where('name', 'LIKE', '%'.$query.'%')
        ->orderBy('name', 'ASC')
        ->paginate(10);

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.subcontractors.index')->with(['subcontractors' => $subcontractors]);         //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("framing.subcontractors.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validator($request->all())->validate();

        DB::beginTransaction();
        try {
  
          $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
          );
  
          Subcontractor::create($data);
  
          DB::commit();
          return redirect('/subcontractors')->with(['success' => 'Subcontractor successfully saved']);
  
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
        $subcontractor = Subcontractor::findOrFail($id);
        return view("framing.subcontractors.edit")->with(['subcontractor' => $subcontractor]);
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

        $this->validate($request, [
            'name' => ['required', 'string', 'max:50', 'unique:subcontractors,name,'. $id],
            'phone' => ['required', 'string', 'max:15', 'unique:subcontractors,phone,' . $id],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:subcontractors,email,'. $id],
        ]);

        DB::beginTransaction();
        try {
  
          $subcontractor = Subcontractor::find($id);
          $subcontractor->name = $request->name;
          $subcontractor->phone = $request->phone;
          $subcontractor->email = $request->email;
          $subcontractor->save();
  
          DB::commit();
          return redirect('/subcontractors')->with(['success' => 'Subcontractor edited successfully']);
  
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
    public function destroy($id)
    {
        Subcontractor::destroy($id);
        return redirect ('subcontractors');
    }
}
