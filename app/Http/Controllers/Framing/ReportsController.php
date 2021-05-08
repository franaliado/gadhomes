<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Community;
use App\Subcontractor;
use PDF;


class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rep_houses()
    {
        $communitys = Community::orderBy('name', 'ASC')->get();
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.rep_houses')->with(['subcontractors' => $subcontractors , 'communitys' => $communitys]);
    }

    public function rep_subcontractors()
    {
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.rep_subcontractors')->with(['subcontractors' => $subcontractors]);
    }

    protected function validator_date(array $data)
    {
        return Validator::make($data, [
            'FromDate' => 'before_or_equal:ToDate',
            'ToDate' => 'after_or_equal:FromDate',
        ]);
    }

    public function rep_expenses()
    {
        $users = User::orderBy('name', 'ASC')->get();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.rep_expenses')->with(['users' => $users]);
    }

    public function rep_expenses_report(Request $request)
    {
        if ($request->FromDate <>  Null or $request->ToDate <>  Null){
            $this->validator_date($request->all())->validate();
           
        }
        return("Si");

        $users = User::orderBy('name', 'ASC')->get();
        return view('framing.reports.rep_expenses')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
