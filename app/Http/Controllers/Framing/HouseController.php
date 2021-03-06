<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\House;
use App\Community;
use App\Subcontractor;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data['houses'] = House::paginate(10);

	$houses = House::with(['community', 'subcontractor'])
		       ->orderBy('address')
		       ->paginate(10);

        return view('framing.houses.index')->with(['houses' => $houses]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communitys = Community::all();
        $subcontractors = Subcontractor::all();
        return view("framing.houses.create", compact('subcontractors'), compact('communitys'));
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'address' => ['required', 'string', 'max:150'],
            'community_id' => ['required', 'integer'],
            'lot' => ['required', 'integer', 'min:4'],
            'state' => ['required'],
            'start_date' => ['required'],
            'subcontractor_id' => ['required', 'integer'],
            'amount_assigned_subc' => ['required'],
        ]);
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
            'address' => $request->address,
            'community_id' => $request->community,
            'lot' => $request->lot,
            'state' => $request->state,
            'start_date' => $request->date("Y-m-d", strtotime(start_date)),
            'withoutpo' => $request->withoutpo,
            'subcontractor_id' => $request->subcontractor,
            'amount_assigned_subc' => $request->amount_assigned_subc
          );
  
          House::create($data);
  
          DB::commit();
          return redirect('/houses')->with(['success' => 'User successfully registered']);
  
        }catch (\Exception $e) {
          DB::rollback();
          return view('houses.create')->with(['error' => $e->getMessage()]);
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
    public function destroy($id)
    {
        //
    }
}
