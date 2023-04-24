@php
use App\Models\Providers;
use App\Models\Enrollees;
use App\Models\Claims;
use App\Models\Clients;
use App\Models\Authorization;
use Carbon\Carbon;

//$premiums = DB::table('premiums')
 //   ->select('cliam_id', 'id', 'provider_id', 'amount')
 //   ->distinct()
 //   ->orderByDesc('id')
 //   ->get();
    
$exhu = 0;

//foreach ($premiums as $premium) {
    //$pcc = $premium['claim_id'];
    //$pid = $premium['id'];
   // $pcnm = $premium['provider_id];
   // $pcam = $premium['amount'];
    
  //  $client = Clients::where('code', $pcc)->first();
 //   $djEX = $client['date_oined'];
//    $deEX = $client['date_exited'];
    
//    $bills = Bill::where('Company', 'like', $cnm . '%')
 //       ->whereBetween('Date of Pay', [$djEX, $deEX])
  //      ->select(DB::raw('SUM(`Amount Paid`) as PA, COUNT(`ID`) as CN'))
   //     ->first();
  //  $pexhh = $bills['PA'];
  //  $pdiff = $pcam - $pexhh;
  //  $pqtz = $pcam / 4;
  //  if ($pdiff <= $pqtz) {
  //      $exhu = $exhu + 1;
    //}
//}


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
    ->where('date_exited', '<=', $ndate)
    ->count();

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
$activeClientsQuery = Clients::select(DB::raw('count(distinct `Code`) as cntCL'))
->where('Status', 'Active')
->where('Name', 'not like', 'Individual%');
$activeClientsResult = $activeClientsQuery->first();
$activeClientCount = $activeClientsResult ? $activeClientsResult->cntCL : 0;

// Query for inactive clients
$inactiveClientsQuery = Clients::select(DB::raw('count(distinct `Code`) as cntCLs'))
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


    @endphp
    <!-- Dashboard -->
    @extends('layouts.app')
    <style>
        .subb {
            /* background: #23c6c8; */
            position: absolute;
            right: 0;
            top: 10px;
            font-size: 12px;
            font-weight: 700;
            color: #000;
            padding: 2px 10px;
            /* background: #1c84c6; */
            border-radius: 2px;
            margin: 0;
        }

        .dash .card .card-body {
            padding: 20px 30px !important;
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
            height: 80px;
            /* set the maximum height of the table */
        }

        .table {
            width: calc(100% - 1.2em);
            margin-left: 0.6em;
            margin-bottom: 1.6em;
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
                            <h5>Providers</h5>
                            <p class="subb" style="background: rgba(0, 128, 0, 0.2);">Active</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h4 class="mb-0">{{$providersCount}}</h4>
                                        <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                                    </div>
                                </div>
                                <p class="text-muted font-weight-normal">Total Registered</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h5>Enrollees</h5>
                            <p class="subb" style="background: rgba(54, 162, 235, 0.2)">Active</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h4 class="mb-0">{{$enrolleesCountActive}}</h4>
                                        <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                                    </div>
                                </div>
                                <p class="text-muted font-weight-normal">Total Enrollees: {{$enrolleesCount}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h5>Claims</h5>
                            <p class="subb" style="background: rgba(255, 206, 86, 0.2)">This Month</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h5 class="mb-0">${{ number_format($claimsSum, 2)}}</h5>
                                        <p class="@if($percentageDifference < 0) text-danger @else text-success @endif ml-2 mb-0 font-weight-medium" style="font-size:11px;">{{ number_format($percentageDifference, 2) }}%</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    @if($percentageDifference < 0) <div class="icon icon-box-danger">
                                        <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                                        @else
                                        <div class="icon icon-box-success">
                                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            @endif
                                        </div>
                                </div>
                                <p class="text-muted font-weight-normal">Last month: ${{ number_format($claimsSumPrev, 2) }}</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h5>Encounters</h5>
                            <p class="subb" style="background: rgba(75, 192, 192, 0.2)">This Month</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h4 class="mb-0">{{$encounterCount}}</h4>
                                        <p class="@if($encounterDifference < 0) text-danger @else text-success @endif ml-2 mb-0 font-weight-medium" style="font-size:11px;">{{ number_format($encounterDifference, 2) }}%</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    @if($encounterDifference < 0) <div class="icon icon-box-danger">
                                        <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                                        @else
                                        <div class="icon icon-box-success">
                                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            @endif
                                        </div>
                                </div>
                                <p class="text-muted font-weight-normal">Last Month: {{$encounterCountPrev}}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title" style="color:#000;">Providers per State</h4>
                            <canvas id="barChart" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title" style="color:#000;">Clients: Active / Inactive</h4>
                            <canvas id="pieChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row grid-margin" style="margin-left: 10px;margin-right: 10px">
                <div class="col-4 card px-4" style="color: #ff0000; border-radius: 25px;height:50px;padding:10px;margin:0 auto;">
                    {{$bill}} Pending Claims requests
                </div>
                <div class="col-4 card px-4" style="color: #ff0000; border-radius: 25px;height:50px;padding:10px;margin:0 auto;">
                    {{ $auth}} Pending Auth. Code
                </div>
                <div class="col-4 card px-4" style="color: #ff0000; border-radius: 25px;height:50px;padding:10px;margin:0 auto;">
                    {{$comp}} Pending Complaints
                </div>
            </div>
            <div class="row grid-margin" style="margin-left: 10px;margin-right: 10px">
                <div class="col-4 card px-4" style="color: #ff0000; border-radius: 25px;height:50px;padding:10px;margin:0 auto;">
                    {{$exhu}} Premiums Expiring
                </div>
                <div class="col-4 card px-4" style="color: #ff0000; border-radius: 25px;height:50px;padding:10px;margin:0 auto;">
                    {{$exhuA}} Contract Expiring
                </div>
                <div class="col-4 card px-4" style="color: #ff0000; border-radius: 25px;height:50px;padding:10px;margin:0 auto;">
                    {{$exhuB}} Enrollee Birthdays
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->

    </div>

    </div>
    </div>

    @endsection
