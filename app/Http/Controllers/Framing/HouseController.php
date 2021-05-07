<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\HouseCreateRequest;
use Illuminate\Support\Facades\Validator;

use DB;
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
    public function index(Request $request)
    {

        $query = trim($request->get('search'));
 
        $houses = House::select('houses.*', 'subcontractors.name as subcontractorName', 'community.name as communityName')                    
            ->leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->leftJoin('community', 'community.id', 'houses.community_id')
            ->where('houses.address', 'LIKE', '%'.$query.'%')
            ->orWhere('houses.lot', 'LIKE', '%'.$query.'%')
            ->orWhere('houses.status', 'LIKE', '%'.$query.'%')
            ->orWhere('community.name', 'LIKE', '%'.$query.'%')
            ->orWhere('subcontractors.name', 'LIKE', '%'.$query.'%')
            ->orderBy('id', 'DESC')
            ->get();

        return view('framing.houses.index')->with(['houses' => $houses]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communitys = Community::orderBy('name', 'ASC')->get();
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();
        return view("framing.houses.create")->with(['subcontractors' => $subcontractors , 'communitys' => $communitys]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseCreateRequest $request)
    {

        DB::beginTransaction();
        try {
  
          $data = array(
            'address' => $request->address,
            'community_id' => $request->community,
            'lot' => $request->lot,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'withoutpo' => ($request->withoutpo) ? intval($request->withoutpo) : 0,
            'subcontractor_id' => $request->subcontractor,
          );
  
          House::create($data);
  
          DB::commit();
          return redirect('/houses')->with(['success' => 'House successfully saved']);
  
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
        $house = House::findOrFail($id);
        
        $communitys = Community::orderBy('name', 'ASC')->get();
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();
        return view("framing.houses.edit")->with(['house' => $house, 'subcontractors' => $subcontractors , 'communitys' => $communitys]);
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
        $community = Community::find($request->community);
        $house = House::find($id);
        if ($house->community_id == $request->community and $house->lot == $request->lot){
            $this->validate($request, [
                'address' => 'required|string|max:150',
                'lot' => 'required|integer',
                'start_date' => 'required',
                'subcontractor' => 'required',
            ]);
        }else{
            $this->validate($request, [
                'address' => 'required|string|max:150',
                'community' => 'unique:houses,community_id,NULL,id,lot,' . $request->lot,
                'lot' => 'required|integer',
                'start_date' => 'required',
                'subcontractor' => 'required',
            ],[
                'community.unique' => 'The house located in the ' . $community->name . ' community and lot '. $request->lot .' already exists'
            ]);
        }
        DB::beginTransaction();
        try {
            $house->address = $request->address;
            $house->community_id = $request->community;
            $house->lot = $request->lot;
            $house->status = $request->status;
            $house->start_date = $request->start_date;
            $house->withoutpo = ($request->withoutpo) ? intval($request->withoutpo) : 0;
            $house->subcontractor_id = $request->subcontractor;
            $house->save();

            DB::commit();
            return redirect('/houses')->with(['success' => 'House edited successfully']);

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
        House::destroy($id);
        return redirect ('houses');
    }

    public function search(Request $request){
        return($request);
        $search=$request->get('search');
        $houses = House::where('address', 'like', '%'.$search.'%' )->get();
        return view('index', ['houses'=>$houses]);
        return view('framing.houses.search')->with(['houses' => $houses]); 
    }
}
