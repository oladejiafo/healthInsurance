<?php

namespace App\Http\Controllers;
use App\Models\Claims;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class ClaimsController extends Controller
{
    // public function claims(ClaimsDataTable $dataTable) {
    //     return $dataTable->render('claims.claims');
    // }

    // public function claims_summary(ClaimsSumDataTable $claimsTable){
    //     return $claimsTable->render('claims.claims-summary');
    // }

    public function claims(Request $request) {
        if (Auth::id()) {

            $hcp_name = $request->query('hcp_name');
            $month = $request->query('month');
            $year = $request->query('year');

            $claims = DB::table('claims')
            ->select(DB::raw('id, `hcp_code`, `hcp_name`, `enrollee_code`, `enrollee_name`,`claim_amount`,`entry_date`, `authorization_code`, `month`, `year`,`status`, `diagnosis`'))
            ->whereNotIn('status', ['Paid', 'Vetted', 'Approved'])
            ->where('hcp_name', '=', $hcp_name)
            ->where('year', '=', $year)
            ->where('month','=', $month)
            ->orderByDesc('id')
            ->get();

            return view('claims.claims',compact('claims'));
        } else {
            return redirect('/');
        }
    }

    public function claimsSummary(){
    
        if (Auth::id()) {

            $claims = DB::table('claims')
            ->select(DB::raw('COUNT(id) as ID, `hcp_code`, `hcp_name`, SUM(`claim_amount`) as amt, `month`, `year`'))
            ->whereNotIn('status', ['Paid', 'Vetted', 'Approved'])
            ->groupBy('hcp_code', 'hcp_name', 'month', 'year')
            ->orderByDesc('id')
            ->get();

            return view('claims.claims-summary',compact('claims'));
        } else {

            return redirect('/');
        }
    }

}
