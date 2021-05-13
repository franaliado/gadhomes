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
use App\Expense;
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
  

    public function report_houses_options(Request $request) 
    {

        if ($request->rephouses == '1'){
            $houses = House::leftJoin('community', 'community.id', 'houses.community_id')
            ->orderBy('community.name', 'ASC')
            ->get();

            if (Auth::user()->role != 1){ return redirect('/home'); }
            return view('framing.reports.report_houses_com')->with(['houses' => $houses]);

        }else{
            $houses = House::leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->orderBy('subcontractors.name', 'ASC')
            ->get();  
            
            if (Auth::user()->role != 1){ return redirect('/home'); }
            return view('framing.reports.report_houses_subc')->with(['houses' => $houses]);
        }
    }
    
    public function rep_houses_options_PDF($option) 
    {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));
        if ($option == '1'){
            $houses = House::leftJoin('community', 'community.id', 'houses.community_id')
                ->orderBy('community.name', 'ASC')
                ->get();

            $pdf = PDF::loadView('framing.pdf.rep_houses_com_pdf', ['houses'=>$houses, 'logo'=>$image])->setPaper("letter", "portrait");
            $namepdf = 'Rep_Houses_Communities';
        }else{
            $houses = House::leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->orderBy('subcontractors.name', 'ASC')
            ->get();

            $pdf = PDF::loadView('framing.pdf.rep_houses_subc_pdf', ['houses'=>$houses, 'logo'=>$image])->setPaper("letter", "portrait");
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
        ]);
    }

    public function rep_expenses()
    {
        $users = User::orderBy('name', 'ASC')->get();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.rep_expenses')->with(['users' => $users]);
    }

    public function report_expenses(Request $request)
    {
        if ($request->FromDate <>  Null or $request->ToDate <>  Null){
            $this->validator_date($request->all())->validate();
        }

        $query = Expense::select('expenses.*');
                if ($request->user <> 0){ 
                    $query->where('user_id', $request->user);
                }
                if ($request->type_expense <> "0"){ 
                    $query->where('type_expense', $request->type_expense);
                }
                if ($request->type_pay <> "0"){ 
                    $query->where('type_pay', $request->type_pay);
                }
                if ($request->FromDate <> Null){ 
                    $query->whereBetween('date', [$request->FromDate, $request->ToDate]);
                    $FromDate = $request->FromDate;
                    $ToDate = $request->ToDate;
                }else{
                    $FromDate = "Null";
                    $ToDate = "Null";
                }
        $expenses = $query->get();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.report_expenses')->with(['expenses' => $expenses, 'users' => $request->user, 'type_expense' => $request->type_expense, 'type_pay' => $request->type_pay, 'FromDate' => $FromDate, 'ToDate' => $ToDate]);
    }


    public function rep_expenses_PDF($users, $type_expense, $type_pay, $FromDate, $ToDate) 
    {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));
        $query = Expense::select('expenses.*');
                if ($users <> 0){ 
                    $query->where('user_id', $users);
                }
                if ($type_expense <> "0"){ 
                    $query->where('type_expense', $type_expense);
                }
                if ($type_pay <> "0"){ 
                    $query->where('type_pay', $type_pay);
                }
                if ($FromDate <> "Null"){ 
                    $query->whereBetween('date', [$FromDate, $ToDate]);
                }
        $expenses = $query->get();

        $pdf = PDF::loadView('framing.pdf.rep_expenses_pdf', ['expenses'=>$expenses, 'logo'=>$image])->setPaper("letter", "portrait");
        $namepdf = 'Rep_Expenses';

        return $pdf->download($namepdf.'.pdf');
    }

}
