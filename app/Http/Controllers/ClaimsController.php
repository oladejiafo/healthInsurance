<?php

namespace App\Http\Controllers;
use App\Models\Claims;
use Illuminate\Http\Request;
use App\DataTables\ClaimsDataTable;

class ClaimsController extends Controller
{
    public function index(ClaimsDataTable $dataTable) {
    //   dd($dataTable);
        return $dataTable->render('claims.index');
    }

    // public function ajax(Request $request, ClaimsDataTable $dataTable)
    // {
    //     return $dataTable->toJson();
    // }
}
