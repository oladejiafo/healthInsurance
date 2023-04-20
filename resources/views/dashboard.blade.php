@php
use App\Models\Providers;
use App\Models\Enrollees;
use App\Models\Claims;
use App\Models\Clients;
use Carbon\Carbon;

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
    $vet = Claims::where('status', 'in', ['Vetted', 'Paid', 'Approved'])
    ->where('month', $thisMonth)
    ->where('year', $thisYear)
    ->sum('paid_amount');

    // If no results found, set the sum to 0
    if ($vet == null) {
    $vet = 0;
    }

    // Retrieve the sum of Bill Amount for bills with status in ('Unvetted', 'Pending') for the current month and year
    $unvet = Claims::whereNotIn('status', ['Vetted', 'Paid'])
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
        .table-grey {
    border: 1px solid #dddddd;
}

.table-grey th,
.table-grey td {
    border: 1px solid #dddddd;
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

            <div class="row">
                <div class="col-6 grid-margin">
                    <div class="card">
                        <div class="card-header">
                            <span class="card-title" style="color:#000;">Claims Analysis</span>
                        </div>
                        <div class="card-body">
                                <table class="table table-bordered table-condensed table-grey table-responsive">
                                    <thead>
                                        <tr>
                                            <th> Visits </th> 
                                            <th> Enrollees </th>
                                            <th> Unvetted Amt </th>
                                            <th> Vetted Amt </th>
                                            <th> Providers </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ number_format($enc) }}</td>
                                            <td>{{ number_format($patPP) }}</td>
                                            <td>{{ number_format($unvet,1) }}</td>
                                            <td>{{ number_format($vet,1) }}</td>
                                            <td>{{ number_format($prov) }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <span class="card-title" style="color:#000;">Summary of Visits</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Primary Health Care</th>
                                            <th>Admissions</th>
                                            <th>Surgeries</th>
                                            <th>Optical Visits</th>
                                            <th>Dental Visits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Jacob</td>
                                            <td>Photoshop</td>
                                            <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>
                                            <td>Pending</td>
                                        </tr>

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