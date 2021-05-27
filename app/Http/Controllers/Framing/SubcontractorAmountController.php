<?php

namespace App\Http\Controllers\Framing;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

use DB;
use App\House;
use App\Community;
use App\Subcontractor;
use App\Additional;

class SubcontractorAmountController extends Controller
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
            ->orWhere('community.name', 'LIKE', '%'.$query.'%')
            ->orWhere('subcontractors.name', 'LIKE', '%'.$query.'%')
            ->orderBy('subcontractors.name', 'ASC')
            ->get();
 
        return view('framing.subcontractor_amount.index')->with(['houses' => $houses]); 
    }

    public function edit($id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }

        $house = House::findOrFail($id);
        
        return view("framing.subcontractor_amount.edit")->with(['house' => $house]);
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
        DB::beginTransaction();
        try {
  
          $house = House::find($id);
          $house->amount_assigned_subc = $request->amount_assigned_subc;
          $house->save();
  
          DB::commit();
          return redirect('/subcontractor_amount')->with(['success' => 'Amount edited successfully']);
  
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
        //
    }
}
