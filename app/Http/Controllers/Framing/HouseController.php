<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\HouseCreateRequest;
use Illuminate\Support\Facades\Validator;
use Auth;

use DB;
use App\House;
use App\Community;
use App\Subcontractor;

class HouseController extends Controller
{

    public function index(Request $request)
    {

        $query = trim($request->get('search'));
 
        $houses = House::select('houses.*', 'subcontractors.name as subcontractorName', 'community.name as communityName')                    
            ->leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->leftJoin('community', 'community.id', 'houses.community_id')
            ->leftJoin('orders', 'orders.house_id', 'houses.id')
            ->distinct()
            ->where('houses.address', 'LIKE', '%'.$query.'%')
            ->orWhere('houses.lot', 'LIKE', '%'.$query.'%')
            ->orWhere('houses.status', 'LIKE', '%'.$query.'%')
            ->orWhere('community.name', 'LIKE', '%'.$query.'%')
            ->orWhere('subcontractors.name', 'LIKE', '%'.$query.'%')
            ->orWhere('orders.num_po', 'LIKE', '%'.$query.'%')
            ->orderBy('community.name', 'ASC')
            ->orderBy('houses.lot', 'ASC')
            ->get();

        return view('framing.houses.index')->with(['houses' => $houses]); 
    }

 
    public function create()
    {
        $communitys = Community::orderBy('name', 'ASC')->get();
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();
        return view("framing.houses.create")->with(['subcontractors' => $subcontractors , 'communitys' => $communitys]);
    }


    public function store(HouseCreateRequest $request)
    {

        DB::beginTransaction();
        try {
  
          $data = array(
            'address' => $request->address,
            'community_id' => $request->community,
            'lot' => $request->lot,
            'status' => 'Pending',
            /**'withoutpo' => ($request->withoutpo) ? intval($request->withoutpo) : 0,*/
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

 
    public function edit($id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }

        $house = House::findOrFail($id);
        
        $communitys = Community::orderBy('name', 'ASC')->get();
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();
        return view("framing.houses.edit")->with(['house' => $house, 'subcontractors' => $subcontractors , 'communitys' => $communitys]);
    }


    public function update(Request $request, $id)
    {
        //Validaciones
        $community = Community::find($request->community);
        $house = House::find($id);
        if ($house->community_id == $request->community and $house->lot == $request->lot){
            $this->validate($request, [
                'address' => ['string', 'max:150', 'nullable'],
                'lot' => 'required|integer',
            ]);
        }else{
            $this->validate($request, [
                'address' => ['string', 'max:150', 'nullable'],
                'community' => 'unique:houses,community_id,NULL,id,lot,' . $request->lot,
                'lot' => 'required|integer',
            ],[
                'community.unique' => 'The house located in the ' . $community->name . ' community and lot '. $request->lot .' already exists'
            ]);
        }
        //

        DB::beginTransaction();
        try {
            $house->address = $request->address;
            $house->community_id = $request->community;
            $house->lot = $request->lot;
            /**$house->withoutpo = ($request->withoutpo) ? intval($request->withoutpo) : 0; */
            $house->subcontractor_id = $request->subcontractor;
            $house->save();

            DB::commit();
            return redirect('/houses')->with(['success' => 'House edited successfully']);

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        House::destroy($id);
        return redirect ('houses');
    }

}
