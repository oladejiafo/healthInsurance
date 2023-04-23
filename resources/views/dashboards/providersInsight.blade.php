@php
use App\Models\Providers;
use App\Models\Enrollees;
use App\Models\Claims;
use App\Models\Clients;
use App\Models\Authorization;
use Carbon\Carbon;


###########################################CLAIMS CHARTS##############################################################
$myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );

######VETTED
$vcl = DB::table('claims')
->select(DB::raw('sum(claim_amount) as claimpV'))
->where('claim_date', '>',$myDate)
->where('status', '=', 'Vetted')
->value('claimpV');

if (!$vcl) {
$vcl = 0;
}

$vclavg = DB::table('claims')
->select(DB::raw('sum(claim_amount) as claimpVavg'))
->where('claim_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 YEAR)'))
->where('status', '=', 'Vetted')
->value('claimpVavg');

if (!$vclavg) {
$vclavg = 0;
}

######UNVETTED
$uvcl = DB::table('claims')
->select(DB::raw('sum(claim_amount) as claimpUV'))
->where('claim_date', '>',$myDate)
->where('status', '=', 'Pending')
->value('claimpUV');

if (!$uvcl) {
$uvcl = 0;
}

$uvclavg = DB::table('claims')
->select(DB::raw('sum(claim_amount) as claimpUVavg'))
->where('claim_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 YEAR)'))
->where('status', '=', 'Pending')
->value('claimpUVavg');

if (!$uvclavg) {
$uvclavg = 0;
}


######PAID
$pdcl = DB::table('claims')
->select(DB::raw('sum(claim_amount) as claimpPD'))
->where('claim_date', '>',$myDate)
->where('status', '=', 'Paid')
->value('claimpPD');

if (!$pdcl) {
$pdcl = 0;
}


$pdclavg = DB::table('claims')
->select(DB::raw('sum(claim_amount) as claimpPDavg'))
->where('claim_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 YEAR)'))
->where('status', '=', 'Paid')
->value('claimpPDavg');

if (!$pdclavg) {
$pdclavg = 0;
}


######ADMISSION
$adcl = DB::table('claims')
->select(DB::raw('sum(claim_amount) as claimpAD'))
->where('claim_date', '>',$myDate)
->whereIn('authorized_service', ['Admission','Adm'])
->value('claimpAD');

if (!$adcl) {
$adcl = 0;
}


$adclavg = DB::table('claims')
->select(DB::raw('sum(claim_amount) as claimpADavg'))
->where('claim_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 YEAR)'))
->whereIn('authorized_service', ['Admission','Adm'])
->value('claimpADavg');

if (!$adclavg) {
$adclavg = 0;
}

##############################################################################################################
$thisMonth = date('F');
$thisYear = date('Y');
$prevdate = date('Y-m-d', strtotime('-2 month', strtotime(date('Y-m-d'))));
$mydate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );

$phc_n = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereNotIn('authorized_service', ['Admission','Hospitalization','Accomodation','GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'OTORHINOLARINGOLOGIST (ENT)', 'OPHTHALMOLOGIST','DENTISTRY', 'DENTAL SURGEON', 'MAXILLO-FACIAL SURGEON','DENTAL'])
->distinct('id')
->count('id');

$phc_nv = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereNotIn('authorized_service', ['Admission','Hospitalization','Accomodation','GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'OTORHINOLARINGOLOGIST (ENT)', 'OPHTHALMOLOGIST','DENTISTRY', 'DENTAL SURGEON', 'MAXILLO-FACIAL SURGEON','DENTAL'])
->where('claim_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 YEAR)'))
->distinct('id')
->count('id');

$adm_n = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereIn('authorized_service', ['Admission','Hospitalization','Accomodation'])
->distinct('id')
->count('id');

$adm_nv = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereIn('authorized_service', ['Admission','Hospitalization','Accomodation'])
->where('claim_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 YEAR)'))
->distinct('id')
->count('id');

$sur_n = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereIn('authorized_service', ['GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'OTORHINOLARINGOLOGIST (ENT)', 'OPHTHALMOLOGIST'])
->distinct('id')
->count('id');

$sur_nv = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereIn('authorized_service', ['GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'OTORHINOLARINGOLOGIST (ENT)', 'OPHTHALMOLOGIST'])
->where('claim_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 YEAR)'))
->distinct('id')
->count('id');

$opt_n = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereIn('authorized_service', ['Optical','Optician','Eyes'])
->distinct('id')
->count('id');

$opt_nv = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereIn('authorized_service', ['Optical','Optician','Eyes'])
->where('claim_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 YEAR)'))
->distinct('id')
->count('id');

$den_n = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereIn('authorized_service', ['DENTISTRY', 'DENTAL SURGEON', 'MAXILLO-FACIAL SURGEON','DENTAL'])
->distinct('id')
->count('id');

$den_nv = Claims::where('month', $thisMonth)
->where('year', $thisYear)
->whereIn('status', ['Unvetted', 'Pending','Vetted', 'Paid', 'Approved'])
->whereIn('authorized_service', ['DENTISTRY', 'DENTAL SURGEON', 'MAXILLO-FACIAL SURGEON','DENTAL'])
->where('claim_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 YEAR)'))
->distinct('id')
->count('id');

#################################################################################################


$bill = Claims::where('status', 'Pending')->distinct('id')->count();
$auth = DB::table('authorization')->where('status', '=', 'Pending')->distinct('id')->count('id');
$comp = DB::table('complaints')
->select(DB::raw('count(distinct id) as cntX1'))
->where('status', '=', 'Pending')
->value('cntX1');

if (!$bill) {
$bill = 0;
}

$ndate = date('Y-m-d', strtotime('+89 day'));
$exhuA = DB::table('clients')
->where('date_exited', '<=', $ndate) ->count();

    $tm = date('m');
    $td = date('d');
    $exhuB = DB::table('enrollees')->whereMonth('DoB', $tm)->whereDay('DoB', $td)->where('status', 'Active')->count();

    $currentMonth = Carbon::now()->format('F');
    $currentYear = Carbon::now()->year;
    $previousMonth = Carbon::now()->subMonth()->format('F');
    $previousYear = Carbon::now()->subYear()->year;

    $claimsSumPrev = Claims::where('month', $previousMonth)
    ->where('year', $currentYear)
    ->sum('claim_amount');

    $claimsSum = Claims::where('month', $currentMonth)
    ->where('year', $currentYear)
    ->sum('claim_amount');

    if ($claimsSumPrev == 0) {
    $percentageDifference = 0; // or whatever default value you prefer
    } else {
    $percentageDifference = ($claimsSumPrev - $claimsSum) / $claimsSum * 100;
    }

    $providersCount = Providers::count();
    $enrolleesCount = Enrollees::count();

    $encounterCountPrev = Claims::where('month', $currentMonth)
    ->where('year', $currentYear)
    ->count();
    $encounterCount = Claims::count();

    $providersCountActive = Providers::where('status', 'Active')->count();
    $enrolleesCountActive = Enrollees::where('status', 'Active')->count();

    if ($encounterCountPrev == 0) {
    $encounterDifference = 0; // or whatever default value you prefer
    } else {
    $encounterDifference = ($encounterCountPrev - $encounterCount) / $encounterCount * 100;
    }


    $queryBar = Providers::select('location', DB::raw('count(id) as cnt'))
    ->groupBy('location')
    ->get();

    $locations = $queryBar->pluck('location')->toArray();
    $counts = $queryBar->pluck('cnt')->toArray();
    $total = array_sum($counts);


    // Calculate due date
    $dueDate = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d'))));

    // Query for active clients
    $activeClientsQuery = Clients::select(DB::raw('count(distinct Code) as cntCL'))
    ->where('Status', 'Active')
    ->where('Name', 'not like', 'Individual%');
    $activeClientsResult = $activeClientsQuery->first();
    $activeClientCount = $activeClientsResult ? $activeClientsResult->cntCL : 0;

    // Query for inactive clients
    $inactiveClientsQuery = Clients::select(DB::raw('count(distinct Code) as cntCLs'))
    ->where('Status', '!=', 'Active')
    ->where('Name', 'not like', 'Individual%');
    $inactiveClientsResult = $inactiveClientsQuery->first();
    $inactiveClientCount = $inactiveClientsResult ? $inactiveClientsResult->cntCLs : 0;

    // Calculate percentages
    $clientCount = $activeClientCount + $inactiveClientCount;
    $activeClientPercentage = ($clientCount > 0) ? ($activeClientCount / $clientCount) * 100 : 0;
    $inactiveClientPercentage = ($clientCount > 0) ? ($inactiveClientCount / $clientCount) * 100 : 0;

    // Build array
    $clients = "['" . $activeClientCount . "', '" . $inactiveClientCount . "']";

    $thisMonth = date('F');
    $thisYear = date('Y');
    $prevdate = date('Y-m-d', strtotime('-2 month', strtotime(date('Y-m-d'))));

    $mydate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );

    // Retrieve the count of distinct IDs for bills with status in ('Unvetted', 'Pending','Vetted', 'Paid', 'Approved') for the current month and year
    $enc = Claims::where('month', $thisMonth)
    ->where('year', $thisYear)
    ->distinct('id')
    ->count('id');
    // If no results found, set the count to 0
    if ($enc == 0) {
    $enc = 0;
    }

    // Retrieve the count of distinct IDs for bills with status in ('Unvetted', 'Pending','Vetted', 'Paid', 'Approved') for the previous month and year
    $encl = Claims::where('status', 'in', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
    ->where('claim_date', '>', $prevdate)
    ->where('claim_date', '<', $mydate) ->distinct('id')
        ->count('id');

        // If no results found, set the count to 0
        if ($encl == 0) {
        $encl = 0;
        }

        // Retrieve the sum of Amount Paid for bills with status in ('Vetted', 'Paid', 'Approved') for the current month and year
        $vet = Claims::where('status', '=', 'Vetted')
        ->where('month', $thisMonth)
        ->where('year', $thisYear)
        ->sum('paid_amount');

        // If no results found, set the sum to 0
        if ($vet == null) {
        $vet = 0;
        }

        // Retrieve the sum of Bill Amount for bills with status in ('Unvetted', 'Pending') for the current month and year
        $unvet = Claims::where('status','=', 'Pending')
        ->where('month', $thisMonth)
        ->where('year', $thisYear)
        ->sum('claim_amount');

        // If no results found, set the sum to 0
        if ($unvet == null) {
        $unvet = 0;
        }

        $prov = Claims::where('month', $thisMonth)
        ->where('year', $thisYear)
        ->distinct('hcp_name')
        ->count();

        if ($prov == 0) {
        $prov = 0;
        }

        // Get the total count of distinct IDs from the eregister table
        $pat = DB::table('enrollees')->distinct('id')->count('id');

        // Get the count of distinct IDs with Status = 'Active' from the eregister table
        $patPP = DB::table('enrollees')->distinct('id')->where('status', 'Active')->count('id');

        // If no rows are returned, set the counts to 0
        if ($pat == 0) {
        $pat = 0;
        }
        if ($patPP == 0) {
        $patPP = 0;
        }

        @endphp
        <!-- Dashboard -->
        @extends('layouts.app')
        <style>
            .subbC {
                position: absolute;
                right: 0;
                top: 0;
                font-size: 11px;
                font-weight: 500;
                color: #000;
                padding: 2px;
                border-radius: 2px;
                margin: 0;
            }

            .avg {
                font-size: 12px;
            }

            .avg_cost {
                font-size: 12px;
                font-weight: 700;
                text-align: right;
                align-content: flex-end;
            }

            .dash .card .card-body {
                padding: 20px 30px !important;

            }

            .card {
                border-radius: 20px !important;
            }

            .dash p {
                margin-bottom: 5px !important;

            }

            .dash .card-header {
                padding: 0.35rem 1.05rem !important;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                height: 150px;
                /* set the maximum height of the table */
            }

            .table {
                width: calc(100% - 1.2em);
                margin-left: 0.6em;
                margin- bottom: 1.6em;
            }

            th {
                font-weight: bold !important;
            }

            td,
            th {
                padding: 10px !important;
            }
        </style>
        <script type='text/javascript'>
            var jstatearray = <?php echo json_encode($locations); ?>;
            var jqueryarray = <?php echo json_encode($counts); ?>;
            var jpiearray = <?php echo $clients; ?>;
        </script>
        @section('content')
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row dash">
                    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <h5>Vetted Claims</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="mb-3">{{number_format($vcl,2)}}</h5>
                                    </div>
                                    <div class="col-4">
                                        <p class="subbC" style="background: rgba(0, 128, 0, 0.2);top:0">This Month</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-muted font-weight-normal avg">Avg. last 12 months: </p>
                                            <span class="avg_cost">{{number_format($vclavg,2)}}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                        <div class="card">
                            <div class="card-header">
                                <h5>Unvetted Claims</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="mb-3">{{number_format($uvcl,2)}}</h5>
                                    </div>
                                    <div class="col-4">
                                        <p class="subbC" style="background: rgba(54, 162, 235, 0.2);top:0">This Month</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-muted font-weight-normal avg">Avg. last 12 months: </p>
                                            <span class="avg_cost">{{number_format($uvclavg,2)}}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <h5>Paid Claims</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="mb-3">{{number_format($pdcl,2)}}</h5>
                                    </div>
                                    <div class="col-4">
                                        <p class="subbC" style="background: rgba(255, 206, 86, 0.2);top:0">This Month</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-muted font-weight-normal avg">Avg. last 12 months: </p>
                                            <span class="avg_cost">{{number_format($pdclavg,2)}}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <h5>Admission Claims</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="mb-3">{{number_format($adcl,2)}}</h5>
                                    </div>
                                    <div class="col-4">
                                        <p class="subbC" style="background: rgba(75, 192, 192, 0.2);top:0">This Month</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-muted font-weight-normal avg">Avg. last 12 months: </p>
                                            <span class="avg_cost">{{number_format($adclavg,2)}}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 grid-margin">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title" style="color:#000;">Claims Analysis</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <table class="table table-hover" style="min-width: 500px;">
                                        <thead>
                                            <tr>
                                                <th> Total<br>Visits </th>
                                                <th> Active<br>Enrollees </th>
                                                <th> Unvetted<br>Amount </th>
                                                <th> Vetted<br>Amount </th>
                                                <th> #Billed<br>Providers </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ number_format($enc) }}</td>
                                                <td>{{ number_format($patPP) }}</td>
                                                <td>{{ number_format($uvcl,2) }}</td>
                                                <td>{{ number_format($vcl,2) }}</td>
                                                <td>{{ number_format($prov) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title" style="color:#000;">Summary of Visits</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <table class="table table-hover" style="min-width: 700px;">
                                        <thead>
                                            <tr>
                                                <th>Primary<br>Health Care</th>
                                                <th>Admissions</th>
                                                <th>Surgeries</th>
                                                <th>Optical<br>Visits</th>
                                                <th>Dental<br>Visits</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ number_format($phc_n) }}</td>
                                                <td>{{ number_format($adm_n) }}</td>
                                                <td>{{ number_format($sur_n) }}</td>
                                                <td>{{ number_format($opt_n) }}</td>
                                                <td>{{ number_format($den_n) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="background-color:#FFE4E1">{{ number_format($phc_n) }}</td>
                                                <td style="background-color:#FFE4E1">{{ number_format($adm_n) }}</td>
                                                <td style="background-color:#FFE4E1">{{ number_format($sur_n) }}</td>
                                                <td style="background-color:#FFE4E1">{{ number_format($opt_n) }}</td>
                                                <td style="background-color:#FFE4E1">{{ number_format($den_n) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header" style="background: rgba(0, 128, 0, 0.2)">
                                <span class="card-title" style="color:#000;">Paid Claims by Package</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <table class="table border-table">
                                        <thead>
                                            <tr style="height:20px">
                                                <th style="height:20px">&nbsp;</th>
                                                <th colspan=3 style="background-color:#F0FFF0x;height:20px">Current Month</th>
                                                <th colspan=3 style="background-color:#FFE4E1x;height:20px">Av. Last 12 Months</th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <font style="font-size:12px">Plan</font>
                                                </th>
                                                <th align="right">
                                                    <font style="font-size:12px;">Claims</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">% of Total</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">&nbsp;</font>
                                                </th>
                                                <th align="right">
                                                    <font style="font-size:12px;">Claims</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">% of Total</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">&nbsp;</font>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                            $thismonth = date('m');
                                            $thisyear = date('Y');

                                            // Sum of claims paid_amount for the current month and year
                                            $claimsPaidThismonth = DB::table('claims')
                                            ->selectRaw('SUM(paid_amount) as BAt')
                                            ->where('status', 'Paid')
                                            ->where('month', $thismonth)
                                            ->where('year', $thisyear)
                                            ->first()->BAt;

                                            // Sum of claims paid_amount in the last year
                                            $claimsPaidLastyear = DB::table('claims')
                                            ->selectRaw('SUM(paid_amount) as BAtv')
                                            ->where('status', 'Paid')
                                            ->where('pay_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 year)'))
                                            ->first()->BAtv;

                                            // Fetching all the plans
                                            $plans = DB::table('plans')
                                            ->select('id', 'plan_name')
                                            ->where('plan_is_active', 1)
                                            ->orderBy('id')
                                            ->get();

                                            @endphp

                                            @foreach ($plans as $plan)
                                            @php

                                            // Sum of claims paid_amount for the current month and year for the current plan
                                            $claimsPaidThismonthByPlan = DB::table('claims')
                                            ->selectRaw('SUM(paid_amount) as BA')
                                            ->join('enrollees', 'claims.enrollee_code', '=', 'enrollees.code')
                                            ->where('claims.status', 'Paid')
                                            ->where('claims.month', $thismonth)
                                            ->where('claims.year', $thisyear)
                                            ->where('enrollees.plan', $plan->id)
                                            ->groupBy('enrollees.plan')
                                            ->first();

                                            // Sum of claims paid_amount in the last year for the current plan
                                            $claimsPaidLastyearByPlan = DB::table('claims')
                                            ->selectRaw('SUM(paid_amount) as BAv')
                                            ->join('enrollees', 'claims.enrollee_code', '=', 'enrollees.code')
                                            ->where('claims.status', 'Paid')
                                            ->where('claims.pay_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 year)'))
                                            ->where('enrollees.plan', $plan->id)
                                            ->groupBy('enrollees.plan')
                                            ->first();

                                            // Calculate the percentage of claims paid for the current month and year for the current plan
                                            if ($claimsPaidThismonthByPlan && $claimsPaidThismonth) {
                                            $percentageclaimsPaidThismonthByPlan = ($claimsPaidThismonthByPlan->BA / $claimsPaidThismonth) * 100;
                                            $cbpx = $claimsPaidThismonthByPlan->BA;
                                            $cbptx = $claimsPaidThismonth;
                                            } else {
                                            $percentageclaimsPaidThismonthByPlan = 0;
                                            $cbpx = 0;
                                            $cbptx = 1;
                                            }

                                            // Calculate the percentage of claims paid in the last year for the current plan
                                            if ($claimsPaidLastyearByPlan && $claimsPaidLastyear) {
                                            $percentageclaimsPaidLastyearByPlan = ($claimsPaidLastyearByPlan->BAv / $claimsPaidLastyear) * 100;
                                            $cbpxv = $claimsPaidLastyearByPlan->BAv;
                                            $cbptxv = $claimsPaidLastyear;
                                            } else {
                                            $percentageclaimsPaidLastyearByPlan = 0;
                                            $cbpxv = 0;
                                            $cbptxv = 1;

                                            }
                                            @endphp

                                            <tr>
                                                <td>
                                                    <font style='font-size:12px'>{{$plan->plan_name}}</font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px'>{{ number_format($cbpx,0) }}</font>
                                                </td>
                                                <td>
                                                    <font style='font-size:12px'>{{ number_format($percentageclaimsPaidThismonthByPlan,2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh"><span class="pie"></span></td>
                                                <td align='left'>
                                                    <font style='font-size:12px;color:#FF6347'>{{ number_format($cbpxv,0) }}</font>
                                                </td>
                                                <td>
                                                    <font style='font-size:12px;color:#FF6347'>{{ number_format($percentageclaimsPaidLastyearByPlan,2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh"><span class="pie"></span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header" style="background: rgba(54, 162, 235, 0.2)">
                                <span class="card-title" style="color:#000;">Admission Claims by Package</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <table class="table border-table">
                                        <thead>
                                            <tr style="height:20px">
                                                <th style="height:20px">&nbsp;</th>
                                                <th colspan=3 style="background-color:#F0FFF0x;height:20px">Current Month</th>
                                                <th colspan=3 style="background-color:#FFE4E1x;height:20px">Av. Last 12 Months</th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <font style="font-size:12px">Plan</font>
                                                </th>
                                                <th align="right">
                                                    <font style="font-size:12px;">Claims</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">% of Total</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">&nbsp;</font>
                                                </th>
                                                <th align="right">
                                                    <font style="font-size:12px;">Claims</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">% of Total</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">&nbsp;</font>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $thismonth = date('m');
                                            $thisyear = date('Y');

                                            // Sum of claims paid_amount for the current month and year
                                            $claimsPaidThismonth = DB::table('claims')
                                            ->selectRaw('SUM(paid_amount) as BAt')
                                            ->whereIn('status', ['Paid','Pending','Vetted','Approved'])
                                            ->where('month', $thismonth)
                                            ->where('year', $thisyear)
                                            ->where('authorized_service', 'Admission' )
                                            ->first()->BAt;

                                            // Sum of claims paid_amount in the last year
                                            $claimsPaidLastyear = DB::table('claims')
                                            ->selectRaw('SUM(paid_amount) as BAtv')
                                            ->whereIn('status', ['Paid','Pending','Vetted','Approved'])
                                            ->where('pay_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 year)'))
                                            ->where('authorized_service', 'Admission' )
                                            ->first()->BAtv;

                                            // Fetching all the plans
                                            $plans = DB::table('plans')
                                            ->select('id', 'plan_name')
                                            ->where('plan_is_active', 1)
                                            ->orderBy('id')
                                            ->get();

                                            @endphp

                                            @foreach ($plans as $plan)
                                            @php

                                            // Sum of claims paid_amount for the current month and year for the current plan
                                            $claimsPaidThismonthByPlan = DB::table('claims')
                                            ->selectRaw('SUM(paid_amount) as BA')
                                            ->join('enrollees', 'claims.enrollee_code', '=', 'enrollees.code')
                                            ->whereIn('claims.status', ['Paid','Pending','Vetted','Approved'])
                                            ->where('claims.month', $thismonth)
                                            ->where('claims.year', $thisyear)
                                            ->where('enrollees.plan', $plan->id)
                                            ->where('authorized_service', 'Admission' )
                                            ->groupBy('enrollees.plan')
                                            ->first();

                                            // Sum of claims paid_amount in the last year for the current plan
                                            $claimsPaidLastyearByPlan = DB::table('claims')
                                            ->selectRaw('SUM(paid_amount) as BAv')
                                            ->join('enrollees', 'claims.enrollee_code', '=', 'enrollees.code')
                                            ->whereIn('claims.status', ['Paid','Pending','Vetted','Approved'])
                                            ->where('claims.pay_date', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 year)'))
                                            ->where('enrollees.plan', $plan->id)
                                            ->where('authorized_service', 'Admission' )
                                            ->groupBy('enrollees.plan')
                                            ->first();

                                            // Calculate the percentage of claims paid for the current month and year for the current plan
                                            if ($claimsPaidThismonthByPlan && $claimsPaidThismonth) {
                                            $percentageclaimsPaidThismonthByPlan = ($claimsPaidThismonthByPlan->BA / $claimsPaidThismonth) * 100;
                                            $cbpx = $claimsPaidThismonthByPlan->BA;
                                            $cbptx = $claimsPaidThismonth;
                                            } else {
                                            $percentageclaimsPaidThismonthByPlan = 0;
                                            $cbpx = 0;
                                            $cbptx = 1;
                                            }

                                            // Calculate the percentage of claims paid in the last year for the current plan
                                            if ($claimsPaidLastyearByPlan && $claimsPaidLastyear) {
                                            $percentageclaimsPaidLastyearByPlan = ($claimsPaidLastyearByPlan->BAv / $claimsPaidLastyear) * 100;
                                            $cbpxv = $claimsPaidLastyearByPlan->BAv;
                                            $cbptxv = $claimsPaidLastyear;
                                            } else {
                                            $percentageclaimsPaidLastyearByPlan = 0;
                                            $cbpxv = 0;
                                            $cbptxv = 1;

                                            }
                                            @endphp

                                            <tr>
                                                <td>
                                                    <font style='font-size:12px'>{{$plan->plan_name}}</font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px'>{{ number_format($cbpx,0) }}</font>
                                                </td>
                                                <td>
                                                    <font style='font-size:12px'>{{ number_format($percentageclaimsPaidThismonthByPlan,2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh"><span class="pie"></span></td>
                                                <td align='left'>
                                                    <font style='font-size:12px;color:#FF6347'>{{ number_format($cbpxv,0) }}</font>
                                                </td>
                                                <td>
                                                    <font style='font-size:12px;color:#FF6347'>{{ number_format($percentageclaimsPaidLastyearByPlan,2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh"><span class="pie"></span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header" style="background: rgba(255, 206, 86, 0.2);">
                                <span class="card-title" style="color:#000;">Claims by Health Category</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <table class="table border-table">
                                        <thead>
                                            <tr style="height:20px">
                                                <th style="height:20px">&nbsp;</th>
                                                <th colspan=2 style="background-color:#F0FFF0x;height:20px">Current Month (Active)</th>
                                                <th colspan=2 style="background-color:#FFE4E1x;height:20px">Av. Last 12 Months (Active)</th>
                                            </tr>
                                            <tr>
                                                <th align="right">
                                                    <font style="font-size:12px;">Health Category</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">Amount</font>
                                                </th>
                                                <th align="center">&nbsp;</th>
                                                <th>
                                                    <font style="font-size:12px;">Amount</font>
                                                </th>
                                                <th align="center">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                            $clPRx = DB::table('claims')->select(DB::raw('sum(claim_amount) as clPRx'))
                                            ->whereIn('status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->where('month', $thisMonth)
                                            ->where('year', $thisYear)
                                            ->value('clPRx');

                                            $clPRxv = DB::table('claims')->select(DB::raw('sum(claim_amount) as clPRxv'))
                                            ->whereIn('status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->whereRaw('claim_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR)')
                                            ->value('clPRxv');

                                            // PRIMARY
                                            $cpr = DB::table('claims')->select(DB::raw('sum(claim_amount) as clPR'))
                                            ->whereIn('status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->where('month', $thisMonth)
                                            ->where('year', $thisYear)
                                            ->whereNotIn('authorized_service', ['Admission', 'Hospitalization', 'Accomodation', 'GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'OTORHINOLARINGOLOGIST (ENT)', 'OPHTHALMOLOGIST', 'DENTISTRY', 'DENTAL SURGEON', 'MAXILLO-FACIAL SURGEON', 'DENTAL'])
                                            ->value('clPR');

                                            $clPRv = DB::table('claims')->select(DB::raw('sum(claim_amount) as clPRv'))
                                            ->whereIn('status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->whereRaw('claim_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR)')
                                            ->whereNotIn('authorized_service', ['Admission', 'Hospitalization', 'Accomodation', 'GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'OTORHINOLARINGOLOGIST (ENT)', 'OPHTHALMOLOGIST', 'DENTISTRY', 'DENTAL SURGEON', 'MAXILLO-FACIAL SURGEON', 'DENTAL'])
                                            ->value('clPRv');

                                            $clPR = ($cpr > 0 && $clPRx > 0) ? $cpr : 0;
                                            $p_pri = ($clPR > 0 && $clPRx > 0) ? ($clPR / $clPRx) * 100 : 0;

                                            $clPRv = ($clPRv > 0 && $clPRxv > 0) ? $clPRv : 0;
                                            $p_priv = ($clPRv > 0 && $clPRxv > 0) ? ($clPRv / $clPRxv) * 100 : 0;
                                            @endphp

                                            <tr>
                                                <td>
                                                    <font style='font-size:12px'>Primary</font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px'>{{ number_format($clPR, 2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh"></td>
                                                <td align='left'>
                                                    <font style='font-size:12px;color:FF6347'>{{ number_format($clPRv,2)}}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh">
                                                    <font style="font-size:12px;color:FF6347">{{ number_format($p_priv,2) }}%</font>
                                                </td>
                                            </tr>

                                            @php
                                            // SECONDARY
                                            $clSC = Claims::where('status', 'Unvetted')
                                            ->orWhere('status', 'Pending')
                                            ->orWhere('status', 'Vetted')
                                            ->orWhere('status', 'Paid')
                                            ->orWhere('status', 'Approved')
                                            ->where('month', $thisMonth)
                                            ->where('year', $thisYear)
                                            ->whereIn('authorized_service', ['GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'MAXILLO-FACIAL SURGEON'])
                                            ->sum('claim_amount');

                                            $clSCv = Claims::where('status', 'Unvetted')
                                            ->orWhere('status', 'Pending')
                                            ->orWhere('status', 'Vetted')
                                            ->orWhere('status', 'Paid')
                                            ->orWhere('status', 'Approved')
                                            ->whereIn('authorized_service', ['GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'MAXILLO-FACIAL SURGEON'])
                                            ->where('claim_date', '>=', \Carbon\Carbon::now()->subYear())
                                            ->sum('claim_amount');

                                            if($clSC > 0 && $clPRx > 0) {
                                            $p_sec = ($clSC / $clPRx) * 100;
                                            } else {
                                            $clSC = 0;
                                            $clSCx = 1;
                                            }

                                            if($clSCv > 0 && $clPRxv > 0) {
                                            $p_secv = ($clSCv / $clPRxv) * 100;
                                            } else {
                                            $clSCv = 0;
                                            $clSCxv = 1;
                                            }
                                            @endphp

                                            <tr>
                                                <td>
                                                    <font style='font-size:12px'>Secondary</font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px'>{{ number_format($clSC, 2) }}</font>
                                                </td>
                                                <td align='left' class='code-adminpro-centerh'>
                                                    <font style='font-size:12px;color:FF6347'>{{ number_format($p_sec, 2) }}%</font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px;color:FF6347'>{{ number_format($clSCv, 2) }}</font>
                                                </td>
                                                <td align='left' class='code-adminpro-centerh'>
                                                    <font style='font-size:12px;color:FF6347'>{{ number_format($p_secv, 2) }}%</font>
                                                </td>
                                            </tr>

                                            @php
                                            // Calculate clSC for the current month and year
                                            $clSC = Claims::where('status', '!=', 'Rejected')
                                            ->whereIn('authorized_service', ['Admission', 'Hospitalization', 'Accomodation'])
                                            ->whereMonth('month', $thisMonth)
                                            ->whereYear('year', $thisYear)
                                            ->sum('claim_amount');

                                            // If there are no results, set clSC to 0
                                            if ($clSC == null) {
                                            $clSC = 0;
                                            }

                                            // Calculate clSCv for the past year
                                            $clSCv = Claims::where('status', '!=', 'Rejected')
                                            ->whereIn('authorized_service', ['Admission', 'Hospitalization', 'Accomodation'])
                                            ->where('claim_date', '>=', \Carbon\Carbon::now()->subYear())
                                            ->sum('claim_amount');

                                            // If there are no results, set clSCv to 0
                                            if ($clSCv == null) {
                                            $clSCv = 0;
                                            }

                                            // Calculate p_adm and p_admv
                                            if ($clPRx > 0) {
                                            $p_adm = ($clSC / $clPRx) * 100;
                                            } else {
                                            $clSC = 0;
                                            $clPRx = 1;
                                            $p_adm = 0;
                                            }

                                            if ($clPRxv > 0) {
                                            $p_admv = ($clSCv / $clPRxv) * 100;
                                            } else {
                                            $clSCv = 0;
                                            $clPRxv = 1;
                                            $p_admv = 0;
                                            }

                                            @endphp
                                            <tr>
                                                <td>
                                                    <font style='font-size:12px'>Admission</font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px'>{{ number_format($clSC,2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh">
                                                    <font style="font-size:12px;color:FF6347">{{ number_format($p_adm,2) }}%</font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px;color:FF6347'>{{ number_format($clSCv,2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh">
                                                    <font style="font-size:12px;color:FF6347">{{ number_format($p_admv,2) }}%</font>
                                                </td>
                                            </tr>

                                            @php
                                            $thisMonth = date('F');
                                            $thisYear = date('Y');

                                            $clSC = Claims::whereIn('status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->where('month', $thisMonth)
                                            ->where('year', $thisYear)
                                            ->whereIn('authorized_service', ['GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'OTORHINOLARINGOLOGIST (ENT)', 'OPHTHALMOLOGIST'])
                                            ->sum('claim_amount');
                                            $clSG = $clSC > 0 && $clPRx > 0 ? ($clSC / $clPRx) * 100 : 0;

                                            $clSCv = Claims::whereIn('status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->where('claim_date', '>=', now()->subYear())
                                            ->whereIn('authorized_service', ['GENERAL SURGEON', 'SURGERY', 'ORTHOPAEDIC', 'TRAUMATOLOGIST', 'OTORHINOLARINGOLOGIST (ENT)', 'OPHTHALMOLOGIST'])
                                            ->sum('claim_amount');
                                            $clSGv = $clSCv > 0 && $clPRxv > 0 ? ($clSCv / $clPRxv) * 100 : 0;
                                            @endphp

                                            <tr>
                                                <td>
                                                    <font style='font-size:12px'>Surgeries</font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px'>{{ number_format($clSG, 2) }}</font>
                                                </td>
                                                <td align='left' class='code-adminpro-centerh'>
                                                    <font style='font-size:12px;color:FF6347'>{{ number_format($clSG > 0 && $clPRx > 0 ? ($clSG / $clPRx) * 100 : 0, 2) }}%</font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px;color:FF6347'>{{ number_format($clSGv, 2) }}</font>
                                                </td>
                                                <td align='left' class='code-adminpro-centerh'>
                                                    <font style='font-size:12px;color:FF6347'>{{ number_format($clSGv > 0 && $clPRxv > 0 ? ($clSGv / $clPRxv) * 100 : 0, 2) }}%</font>
                                                </td>
                                            </tr>

                                            @php

                                            $claims_this_month = Claims::selectRaw('SUM(claim_amount) as clSC')
                                            ->whereIn('status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->whereMonth('claim_date', $thisMonth)
                                            ->whereYear('claim_date', $thisYear)
                                            ->whereIn('authorized_service', ['Optical', 'Optician', 'Eyes'])
                                            ->first();
                                            $clOP = ($claims_this_month) ? $claims_this_month->clSC : 0;

                                            $claims_this_year = Claims::selectRaw('SUM(claim_amount) as clSCv')
                                            ->whereIn('status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->where('claim_date', '>=', now()->subYear())
                                            ->whereIn('authorized_service', ['Optical', 'Optician', 'Eyes'])
                                            ->first();
                                            $clOPv = ($claims_this_year) ? $claims_this_year->clSCv : 0;

                                            if($clOP > 0 && $clPRx > 0) {
                                            $p_opt = ($clOP / $clPRx) * 100;
                                            } else {
                                            $p_opt=0;
                                            $clOP = 0;
                                            $clPRx = 1;
                                            }

                                            if($clOPv > 0 && $clPRxv > 0) {
                                            $p_optv = ($clOPv / $clPRxv) * 100;
                                            } else {
                                            $p_optv=0;
                                            $clOPv = 0;
                                            $clPRxv = 1;
                                            }
                                            @endphp


                                            <tr>
                                                <td>
                                                    <font style="font-size:12px">Optical</font>
                                                </td>
                                                <td align="left">
                                                    <font style="font-size:12px">{{ number_format($clOP, 2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh">
                                                    <font style="font-size:12px;color:FF6347">{{ number_format($p_opt, 2) }}%</font>
                                                </td>
                                                <td align="left">
                                                    <font style="font-size:12px;color:FF6347">{{ number_format($clOPv, 2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh">
                                                    <font style="font-size:12px;color:FF6347">{{ number_format($p_optv, 2) }}%</font>
                                                </td>
                                            </tr>


                                            @php

                                            // Get current month and year
                                            $thisMonth = date('m');
                                            $thisYear = date('Y');

                                            // Get total claim_amount for Dental claims for current month and year
                                            $clDT = Claims::where('status', '!=', 'Declined')
                                            ->where('month', $thisMonth)
                                            ->where('year', $thisYear)
                                            ->whereIn('authorized_service', ['DENTISTRY', 'DENTAL SURGEON', 'MAXILLO-FACIAL SURGEON', 'DENTAL'])
                                            ->sum('claim_amount');

                                            // Get total claim_amount for Dental claims in the last year
                                            $clDTv = Claims::where('status', '!=', 'Declined')
                                            ->where('authorized_service', '!=', '')
                                            ->whereIn('authorized_service', ['DENTISTRY', 'DENTAL SURGEON', 'MAXILLO-FACIAL SURGEON', 'DENTAL'])
                                            ->where('claim_date', '>=', date('Y-m-d', strtotime('-1 year')))
                                            ->sum('claim_amount');

                                            // Calculate percentage of Dental claims compared to all claims for current month and year
                                            $clPRx = Claims::where('status', '!=', 'Declined')
                                            ->where('month', $thisMonth)
                                            ->where('year', $thisYear)
                                            ->sum('claim_amount');

                                            if ($clPRx > 0) {
                                            $p_dent = ($clDT / $clPRx) * 100;
                                            } else {
                                            $p_dent=0;
                                            $clDT = 0;
                                            $clPRx = 1;
                                            }

                                            // Calculate percentage of Dental claims compared to all claims in the last year
                                            $clPRxv = Claims::where('status', '!=', 'Declined')
                                            ->where('authorized_service', '!=', '')
                                            ->where('claim_date', '>=', date('Y-m-d', strtotime('-1 year')))
                                            ->sum('claim_amount');

                                            if ($clPRxv > 0) {
                                            $p_dentv = ($clDTv / $clPRxv) * 100;
                                            } else {
                                            $p_dentv=0;
                                            $clDTv = 0;
                                            $clPRxv = 1;
                                            }
                                            @endphp

                                            <tr>
                                                <td>
                                                    <font style="font-size:12px">Dental</font>
                                                </td>
                                                <td align="left">
                                                    <font style="font-size:12px">{{ number_format($clDT, 2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh">
                                                    <font style="font-size:12px;color:FF6347">{{ number_format($p_dent, 2) }}%</font>
                                                </td>
                                                <td align="left">
                                                    <font style="font-size:12px;color:FF6347">{{ number_format($clDTv, 2) }}</font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh">
                                                    <font style="font-size:12px;color:FF6347">{{ number_format($p_dentv, 2) }}%</font>
                                                </td>
                                            </tr>




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header" style="background: rgba(75, 192, 192, 0.2);">
                                <span class="card-title" style="color:#000;">Health Category Claims by Package</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <table class="table border-table">
                                        <thead>
                                            <tr>
                                                <th align="right">
                                                    <font style="font-size:12px;">&nbsp;</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">Primary</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">Secondary</font>
                                                </th>
                                                <th>
                                                    <font style="font-size:12px;">Tertiary</font>
                                                </th>
                                                <th align="center">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $thismonth = date('m');
                                            $thisyear = date('Y');

                                            // Fetching all the plans
                                            $plans = DB::table('plans')
                                            ->select('id', 'plan_name')
                                            ->where('plan_is_active', 1)
                                            ->orderBy('id')
                                            ->get();
                                            @endphp

                                            @foreach ($plans as $plan)
                                            @php

                                            // Get the plan name based on the foreign key
                                            //$plan = Plan::findOrFail($plans)->plan_name;

                                            // Get the total claim_amount for each type of healthcare plan
                                            $primaryClaims = DB::table('claims')
                                            ->join('providers', 'claims.hcp_code', '=', 'providers.code')
                                            ->join('enrollees', 'claims.enrollee_code', '=', 'enrollees.code')
                                            ->whereIn('claims.status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->where('claims.month', $thisMonth)
                                            ->where('claims.year', $thisYear)
                                            ->where('providers.provider_type', 'Primary')
                                            ->where('enrollees.plan', $plan->id)
                                            ->sum('claim_amount');

                                            $secondaryClaims = DB::table('claims')
                                            ->join('providers', 'claims.hcp_code', '=', 'providers.code')
                                            ->join('enrollees', 'claims.enrollee_code', '=', 'enrollees.code')
                                            ->whereIn('claims.status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->where('claims.month', $thisMonth)
                                            ->where('claims.year', $thisYear)
                                            ->where('providers.provider_type', 'Secondary')
                                            ->where('enrollees.plan', $plan->id)
                                            ->sum('claim_amount');

                                            $tertiaryClaims = DB::table('claims')
                                            ->join('providers', 'claims.hcp_code', '=', 'providers.code')
                                            ->join('enrollees', 'claims.enrollee_code', '=', 'enrollees.code')
                                            ->whereIn('claims.status', ['Unvetted', 'Pending', 'Vetted', 'Paid', 'Approved'])
                                            ->where('claims.month', $thisMonth)
                                            ->where('claims.year', $thisYear)
                                            ->where('providers.provider_type', 'Tertiary')
                                            ->where('enrollees.plan', $plan->id)
                                            ->sum('claim_amount');

                                            // Set default values if there are no claims for each type of healthcare plan
                                            $clHPx = $primaryClaims > 0 ? $primaryClaims : 4;
                                            $clHSx = $secondaryClaims > 0 ? $secondaryClaims : 8;
                                            $clHTx = $tertiaryClaims > 0 ? $tertiaryClaims : 16;

                                            @endphp


                                            <tr>
                                                <td>
                                                    <font style='font-size:12px'> {{$plan->plan_name}} </font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px'>{{ number_format($clHPx,2)}} </font>
                                                </td>
                                                <td align="left">
                                                    <font style="font-size:12px">{{ number_format($clHSx,2)}} </font>
                                                </td>
                                                <td align='left'>
                                                    <font style='font-size:12px'>{{ number_format($clHTx,2)}} </font>
                                                </td>
                                                <td align="left" class="code-adminpro-centerh"></td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h4 class="card-title">Messages</h4>
                                    <p class="text-muted mb-1 small">View all</p>
                                </div>
                                <div class="preview-list">
                                    <div class="preview-item border-bottom">
                                        <div class="preview-thumbnail">
                                            <img src="assets/images/faces/face6.jpg" alt="image" class="rounded-circle" />
                                        </div>
                                        <div class="preview-item-content d-flex flex-grow">
                                            <div class="flex-grow">
                                                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                    <h6 class="preview-subject">Leonard</h6>
                                                    <p class="text-muted text-small">5 minutes ago</p>
                                                </div>
                                                <p class="text-muted">Well, it seems to be working now.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-item border-bottom">
                                        <div class="preview-thumbnail">
                                            <img src="assets/images/faces/face8.jpg" alt="image" class="rounded-circle" />
                                        </div>
                                        <div class="preview-item-content d-flex flex-grow">
                                            <div class="flex-grow">
                                                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                    <h6 class="preview-subject">Luella Mills</h6>
                                                    <p class="text-muted text-small">10 Minutes Ago</p>
                                                </div>
                                                <p class="text-muted">Well, it seems to be working now.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-item border-bottom">
                                        <div class="preview-thumbnail">
                                            <img src="assets/images/faces/face9.jpg" alt="image" class="rounded-circle" />
                                        </div>
                                        <div class="preview-item-content d-flex flex-grow">
                                            <div class="flex-grow">
                                                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                    <h6 class="preview-subject">Ethel Kelly</h6>
                                                    <p class="text-muted text-small">2 Hours Ago</p>
                                                </div>
                                                <p class="text-muted">Please review the tickets</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-item border-bottom">
                                        <div class="preview-thumbnail">
                                            <img src="assets/images/faces/face11.jpg" alt="image" class="rounded-circle" />
                                        </div>
                                        <div class="preview-item-content d-flex flex-grow">
                                            <div class="flex-grow">
                                                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                    <h6 class="preview-subject">Herman May</h6>
                                                    <p class="text-muted text-small">4 Hours Ago</p>
                                                </div>
                                                <p class="text-muted">Thanks a lot. It was easy to fix it .</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Portfolio Slide</h4>
                                <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel" id="owl-carousel-basic">
                                    <div class="item">
                                        <img src="assets/images/dashboard/Rectangle.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="assets/images/dashboard/Img_5.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="assets/images/dashboard/img_6.jpg" alt="">
                                    </div>
                                </div>
                                <div class="d-flex py-4">
                                    <div class="preview-list w-100">
                                        <div class="preview-item p-0">
                                            <div class="preview-thumbnail">
                                                <img src="assets/images/faces/face12.jpg" class="rounded-circle" alt="">
                                            </div>
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <h6 class="preview-subject">CeeCee Bass</h6>
                                                        <p class="text-muted text-small">4 Hours Ago</p>
                                                    </div>
                                                    <p class="text-muted">Well, it seems to be working now.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted">Well, it seems to be working now. </p>
                                <div class="progress progress-md portfolio-progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">To do list</h4>
                                <div class="add-items d-flex">
                                    <input type="text" class="form-control todo-list-input" placeholder="enter task..">
                                    <button class="add btn btn-primary todo-list-add-btn">Add</button>
                                </div>
                                <div class="list-wrapper">
                                    <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
                                        <li>
                                            <div class="form-check form-check-primary">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox"> Create invoice </label>
                                            </div>
                                            <i class="remove mdi mdi-close-box"></i>
                                        </li>
                                        <li>
                                            <div class="form-check form-check-primary">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox"> Meeting with Alita </label>
                                            </div>
                                            <i class="remove mdi mdi-close-box"></i>
                                        </li>
                                        <li class="completed">
                                            <div class="form-check form-check-primary">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox" checked> Prepare for presentation
                                                </label>
                                            </div>
                                            <i class="remove mdi mdi-close-box"></i>
                                        </li>
                                        <li>
                                            <div class="form-check form-check-primary">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox"> Plan weekend outing </label>
                                            </div>
                                            <i class="remove mdi mdi-close-box"></i>
                                        </li>
                                        <li>
                                            <div class="form-check form-check-primary">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                                            </div>
                                            <i class="remove mdi mdi-close-box"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- content-wrapper ends -->

        </div>

        </div>
        </div>

        @endsection