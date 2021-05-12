<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

use App\User;
use App\House;
use App\Community;
use App\Subcontractor;
use PDF;


class ReportsController extends Controller
{
    /**
     * HOUSES.
     */
    public function rep_houses()
    {
        $communitys = Community::orderBy('name', 'ASC')->get();
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.rep_houses')->with(['subcontractors' => $subcontractors , 'communitys' => $communitys]);
    }
  

    public function rep_houses_options(Request $request) 
    {

        if ($request->rephouses == '1'){
            $houses = House::leftJoin('community', 'community.id', 'houses.community_id')
            ->orderBy('community.name', 'ASC')
            ->get();

            if (Auth::user()->role != 1){ return redirect('/home'); }
            return view('framing.reports.rep_houses_com')->with(['houses' => $houses]);

        }else{
            $houses = House::leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->orderBy('subcontractors.name', 'ASC')
            ->get();  
            
            if (Auth::user()->role != 1){ return redirect('/home'); }
            return view('framing.reports.rep_houses_subc')->with(['houses' => $houses]);
        }

    }
    
    public function rep_houses_options_PDF($option) 
    {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));
        if ($option == '1'){
            $houses = House::leftJoin('community', 'community.id', 'houses.community_id')
                ->orderBy('community.name', 'ASC')
                ->get();

            $pdf = PDF::loadView('framing.pdf.rep_houses_com', ['houses'=>$houses, 'logo'=>$image])->setPaper("letter", "portrait");
            $namepdf = 'Rep_Houses_Communities';
        }else{
            $houses = House::leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->orderBy('subcontractors.name', 'ASC')
            ->get();

            $pdf = PDF::loadView('framing.pdf.rep_houses_subc', ['houses'=>$houses, 'logo'=>$image])->setPaper("letter", "portrait");
            $namepdf = 'Rep_Houses_Subcontractors';
        }
        return $pdf->download($namepdf.'.pdf');
    }


    /**
     * SUBCONTRACTORS.
     */
    public function rep_subcontractors()
    {
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.rep_subcontractors')->with(['subcontractors' => $subcontractors]);
    }


    /**
     * EXPENSES.
     */
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

}
