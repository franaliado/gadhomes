<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

use DB;
use App\Community;

class CommunityController extends Controller
{

    public function index()
    {
        //$query = trim($request->get('search'));

        $community = Community::select('community.id', 'community.name')
        ->orderBy('community.name', 'ASC')
        ->get();

        //if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.community.index')->with(['community' => $community]);
    }


    public function create()
    {
        return view("framing.community.create");
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
  
          $data = array(
            'name' => $request->name,
          );
  
          Community::create($data);
  
          DB::commit();

          return redirect('/community')->with(['success' => 'Community successfully saved']);

        }catch (\Exception $e) {
            DB::rollback();
	        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        if (Auth::user()->role != 1){ return redirect('/home'); }
        
        $community = Community::findOrFail($id);
        return view("framing.community.edit")->with(['community' => $community]);
    }


    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try {
  
          $community = Community::find($id);
          $community->name = $request->name;
          $community->save();
  
          DB::commit();

          return redirect('/community')->with(['success' => 'Community successfully edit']);

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
