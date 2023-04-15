<?php

namespace App\Http\Controllers;
use App\Models\Claims;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
// use App\DataTables\ClaimsDataTable;
// use App\DataTables\ClaimsSumDataTable;

class ClaimsController extends Controller
{
    // public function claims(ClaimsDataTable $dataTable) {
    //     return $dataTable->render('claims.claims');
    // }

    // public function claims_summary(ClaimsSumDataTable $claimsTable){
    //     return $claimsTable->render('claims.claims-summary');
    // }

    public function claims($hcp, $month, $year) {
        if (Auth::id()) {

            
            // $ppay = family_breakdown::where('destination_id', '=', $id)
            //     ->where('pricing_plan_type', '=', Session::get('packageType'))
            //     ->where('no_of_parent', '=', $parentt)
            //     ->where('no_of_children', '=', $kids)
            //     ->where('status', 'CURRENT')
            //     ->orderBy('sub_total', 'asc')
            //     ->first();

            return view('claims.claims');
        } else {
            return redirect('/');
        }
    }

    public function claimsSummary(){
    
        if (Auth::id()) {

            $claims = DB::table('claims')
            ->select(DB::raw('COUNT(id) as ID, `entry_date`, `hcp_code`, `hcp_name`, SUM(`claim_amount`) as amt, `status`, `month`, `year`'))
            ->whereNotIn('status', ['Paid', 'Vetted', 'Approved'])
            ->groupBy('hcp_code', 'hcp_name', 'month', 'year','entry_date','status')
            ->orderByDesc('id')
            ->get();

            return view('claims.claims-summary',compact('claims'));
        } else {

            return redirect('/');
        }
    }

}
