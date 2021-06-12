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
        $communitys = Community::orderBy('name', 'ASC')->get();
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();
        $houses = House::all();

        return view('framing.reports.rep_houses')->with(['subcontractors' => $subcontractors , 'communitys' => $communitys, 'houses' => $houses]);
    }
  

    public function report_houses(Request $request) 
    {
        $query = House::select('houses.*', 'subcontractors.name as subcontractorName')
            ->leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
            ->leftJoin('community', 'community.id', 'houses.community_id')
            ->orderBy('community.name', 'ASC')
            ->orderBy('houses.lot', 'ASC');
            if ($request->status <> "0"){ 
                $query->where('status', $request->status);
            }
            if ($request->community <> "0"){ 
                $query->where('community_id', $request->community);
            }
            if ($request->subcontractor <> "0"){ 
                $query->where('subcontractor_id', $request->subcontractor);
            }
            $houses = $query->get();

        $community = Community::find($request->community);
        $subcontractor = Subcontractor::find($request->subcontractor);

        return view('framing.reports.report_houses')->with(['houses' => $houses, 'status' => $request->status, 'community_id' => $request->community, 'community' => $community, 'subcontractor_id' => $request->subcontractor, 'subcontractor' => $subcontractor]);
    }
    
    public function rep_houses_PDF($status, $community_id, $subcontractor_id) 
    {
        $image = base64_encode(file_get_contents(public_path('/images/logo_invoice.jpg')));

        $namepdf = "";
        $query = House::select('houses.*', 'subcontractors.name as subcontractorName')
        ->leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
        ->leftJoin('community', 'community.id', 'houses.community_id')
        ->orderBy('community.name', 'ASC')
        ->orderBy('houses.lot', 'ASC');
        if ($status <> "0"){ 
            $query->where('status', $status);
            $namepdf = "-status";
        }
        if ($community_id <> "0"){ 
            $query->where('community_id', $community_id);
            $namepdf .= "-community";
        }
        if ($subcontractor_id <> "0"){ 
            $query->where('subcontractor_id', $subcontractor_id);
            $namepdf .= "-subcontractor";
        }
        $houses = $query->get();
        
        $community = Community::find($community_id);
        $subcontractor = Subcontractor::find($subcontractor_id);

        $pdf = PDF::loadView('framing.pdf.rep_houses_pdf', ['houses'=>$houses, 'logo'=>$image, 'status' => $status, 'community_id' => $community_id, 'community' => $community, 'subcontractor_id' => $subcontractor_id, 'subcontractor' => $subcontractor])->setPaper("letter", "portrait");
        $namepdf = 'Houses'.$namepdf;
        return $pdf->download($namepdf.'.pdf');
    }



    /**
     * SUBCONTRACTORS.
     */
    public function rep_subcontractors()
    {
        $subcontractors = Subcontractor::orderBy('name', 'ASC')->get();

        $community = Community::orderBy('name', 'ASC')->get();

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

                return view('framing.reports.report_subcontractor_subc')->with(['subcontractor' => $subcontractor, 'tools' => $tools, 'payments' => $payments, 'FromDate' => $FromDate, 'ToDate' => $ToDate]);
        }else{

            $community = Community::where('id', $request->community)
                ->first();

            $houses = House::leftJoin('subcontractors', 'subcontractors.id', 'houses.subcontractor_id')
                ->where('community_id', $request->community)
                ->select('community_id', 'subcontractor_id',
                    DB::raw('SUM(amount_assigned_subc) as Total')
                )
                ->groupBy('subcontractor_id', 'community_id')
                ->get();
            
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
        $expenses = Expense::all();

        return view('framing.reports.rep_expenses')->with(['users' => $users, 'expenses' => $expenses]);
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

        $user = User::find($request->user);

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
                $namepdf .= "-type_expense";
            }
            if ($type_pay <> "0"){ 
                $query->where('type_pay', $type_pay);
                $namepdf .= "-type_pay";
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
