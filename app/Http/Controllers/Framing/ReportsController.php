<?php

namespace App\Http\Controllers\Framing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

use DB;
use App\User;
use App\House;
use App\Community;
use App\Subcontractor;
use App\Tool;
use App\Payment;
use App\Expense;
use PDF;
use PhpParser\Node\Stmt\Return_;

class ReportsController extends Controller
{
    /**
     * HOUSES.
     */
    public function rep_houses()
    {
        $community = Community::orderBy('name', 'ASC')->get();
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.rep_houses')->with(['subcontractors' => $subcontractors , 'community' => $community]);
    }
  

    public function report_houses_options(Request $request) 
    {
        if ($request->community){
            $houses = House::leftJoin('community', 'community.id', 'houses.community_id')
                ->leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
                ->orderBy('subcontractors.name', 'ASC')
                ->where('community_id', $request->community)
                ->where('status', $request->status)
                ->get();

            $community = Community::find($request->community);

            if (Auth::user()->role != 1){ return redirect('/home'); }
            return view('framing.reports.report_houses_com')->with(['houses' => $houses, 'status' => $request->status, 'community' => $community]);

        }else{
            $houses = House::leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
                ->leftJoin('community', 'community.id', 'houses.community_id')
                ->orderBy('community.name', 'ASC')
                ->where('subcontractor_id', $request->subcontractor)
                ->where('status', $request->status)
                ->get();
            
            $subcontractor = Subcontractor::find($request->subcontractor);

            if (Auth::user()->role != 1){ return redirect('/home'); }
            return view('framing.reports.report_houses_subc')->with(['houses' => $houses, 'status' => $request->status, 'subcontractor' => $subcontractor]);
        }
    }
    
    public function rep_houses_com_PDF($status, $community_id) 
    {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));

        $houses = House::leftJoin('community', 'community.id', 'houses.community_id')
            ->leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->orderBy('subcontractors.name', 'ASC')
            ->where('community_id', $community_id)
            ->where('status', $status)
            ->get();
        
        $community = Community::find($community_id);

        $pdf = PDF::loadView('framing.pdf.rep_houses_com_pdf', ['houses'=>$houses, 'logo'=>$image, 'status' => $status, 'community' => $community])->setPaper("letter", "portrait");
        $namepdf = 'Rep_Houses_Communities';
        return $pdf->download($namepdf.'.pdf');
    }

    public function rep_houses_subc_PDF($status, $subcontractor_id) 
    {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));

        $houses = House::leftJoin('community', 'community.id', 'houses.community_id')
            ->leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->orderBy('subcontractors.name', 'ASC')
            ->where('subcontractor_id', $subcontractor_id)
            ->where('status', $status)
            ->get();
        
        $subcontractor = Subcontractor::find($subcontractor_id);

        $pdf = PDF::loadView('framing.pdf.rep_houses_subc_pdf', ['houses'=>$houses, 'logo'=>$image, 'status' => $status, 'subcontractor' => $subcontractor])->setPaper("letter", "portrait");
        $namepdf = 'Rep_Houses_Subcontractors';
        return $pdf->download($namepdf.'.pdf');
    }



    /**
     * SUBCONTRACTORS.
     */
    public function rep_subcontractors()
    {
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();

        $community = Community::orderBy('name', 'ASC')->get();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.rep_subcontractors')->with(['subcontractors' => $subcontractors, 'community' => $community]);
    }


    public function report_subcontractors(Request $request) 
    {
        if ($request->FromDate <>  Null or $request->ToDate <>  Null){
            $this->validator_date($request->all())->validate();
        }

        $FromDate = $request->FromDate;
        $ToDate = $request->ToDate;
 
        if ($request->subcontractor){

            $subcontractor = Subcontractor::where('id', $request->subcontractor)
                ->first();

            $tools = Tool::where('subcontractor_id', $request->subcontractor)
                ->whereBetween('date', [$request->FromDate, $request->ToDate])
                ->orderBy('date', 'ASC')
                ->get();

            $payments = Payment::where('subcontractor_id', $request->subcontractor)
                ->whereBetween('date', [$request->FromDate, $request->ToDate])
                ->orderBy('date', 'ASC')
                ->get();

            if (Auth::user()->role != 1){ return redirect('/home'); }
            return view('framing.reports.report_subcontractor_subc')->with(['subcontractor' => $subcontractor, 'tools' => $tools, 'payments' => $payments, 'FromDate' => $FromDate, 'ToDate' => $ToDate]);
        }else{
            $houses = House::leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
                ->where('community_id', $request->community)
                ->select('community_id', 'subcontractor_id',
                    DB::raw('SUM(amount_assigned_subc) as Total')
                )
                ->groupBy('subcontractor_id', 'community_id')
                ->get();
            
            $community = Community::where('id', $request->community)
                ->first();

        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.report_subcontractor_com')->with(['houses' => $houses, 'community' => $community, 'FromDate' => $FromDate, 'ToDate' => $ToDate]);
        }
    }


    public function rep_subcontractor_subc_PDF($subcontractor_id, $FromDate, $ToDate) 
    {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));
        
        $namepdf = "";
        $subcontractor = Subcontractor::where('id', $subcontractor_id)
            ->first();

        $tools = Tool::where('subcontractor_id', $subcontractor_id)
            ->whereBetween('date', [$FromDate, $ToDate])
            ->orderBy('date', 'ASC')
            ->get();

        $payments = Payment::where('subcontractor_id', $subcontractor_id)
            ->whereBetween('date', [$FromDate, $ToDate])
            ->orderBy('date', 'ASC')
            ->get();

        $pdf = PDF::loadView('framing.pdf.rep_subcontractor_subc_pdf', ['subcontractor'=>$subcontractor, 'logo'=>$image, 'tools' => $tools, 'payments' => $payments, 'FromDate' => $FromDate, 'ToDate' => $ToDate])->setPaper("letter", "portrait");
        $namepdf = 'Rep_Subcontractor';

        return $pdf->download($namepdf.'.pdf');
    }


    public function rep_subcontractor_com_PDF($community_id, $FromDate, $ToDate) 
    {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));
        
        $houses = House::leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->where('community_id', $community_id)
            ->select('community_id', 'subcontractor_id',
                DB::raw('SUM(amount_assigned_subc) as Total')
            )
            ->groupBy('subcontractor_id', 'community_id')
            ->get();
        
        $community = Community::where('id', $community_id)
            ->first();

        $pdf = PDF::loadView('framing.pdf.rep_subcontractor_com_pdf', ['houses'=>$houses, 'logo'=>$image, 'community' => $community, 'FromDate' => $FromDate, 'ToDate' => $ToDate])->setPaper("letter", "portrait");
        $namepdf = 'Rep_Subc_for_Community';

        return $pdf->download($namepdf.'.pdf');
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

        if($request->user == ""){$request->user = 0;}
        if($request->type_expense == ""){$request->type_expense = 0;}
        if($request->type_pay == ""){$request->type_pay = 0;}

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

        $user = User::find($request->user);

 
        if (Auth::user()->role != 1){ return redirect('/home'); }
        return view('framing.reports.report_expenses')->with(['expenses' => $expenses, 'user' => $user, 'users' => $request->user, 'type_expense' => $request->type_expense, 'type_pay' => $request->type_pay, 'FromDate' => $FromDate, 'ToDate' => $ToDate]);
    }


    public function rep_expenses_PDF($users, $type_expense, $type_pay, $FromDate, $ToDate) 
    {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));
        
        $namepdf = "";
        $query = Expense::select('expenses.*');
                if ($users <> 0){ 
                    $query->where('user_id', $users);
                    $namepdf = "-user";
                }
                if ($type_expense <> "0"){ 
                    $query->where('type_expense', $type_expense);
                    $namepdf = "-type_expense";
                }
                if ($type_pay <> "0"){ 
                    $query->where('type_pay', $type_pay);
                    $namepdf = "-type_pay";
                }
                if ($FromDate <> "Null"){ 
                    $query->whereBetween('date', [$FromDate, $ToDate]);
                }
        $expenses = $query->get();

        $user = User::find($users);

        $pdf = PDF::loadView('framing.pdf.rep_expenses_pdf', ['expenses'=>$expenses, 'logo'=>$image, 'user' => $user, 'users' => $users, 'type_expense' => $type_expense, 'type_pay' => $type_pay, 'FromDate' => $FromDate, 'ToDate' => $ToDate])->setPaper("letter", "portrait");
        $namepdf = 'Rep_Expenses'.$namepdf;

        return $pdf->download($namepdf.'.pdf');
    }

}
