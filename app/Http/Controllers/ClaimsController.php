<?php

namespace App\Http\Controllers;
use App\Models\Claims;
use Illuminate\Http\Request;
use App\DataTables\ClaimsDataTable;
use App\DataTables\ClaimsSumDataTable;

class ClaimsController extends Controller
{
    public function claims(ClaimsDataTable $dataTable) {
        return $dataTable->render('claims.claims');
    }

    public function claims_summary(ClaimsSumDataTable $claimsTable){
        return $claimsTable->render('claims.claims-summary');
    }

    // public function ajax(Request $request, ClaimsDataTable $dataTable)
    // {
    //     return $dataTable->toJson();
    // }
}
