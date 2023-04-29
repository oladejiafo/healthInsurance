<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/claims.css')}}">
<!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
<!-- normalize CSS
  ============================================ -->
<link rel="stylesheet" href="css/data-table/bootstrap-table.css">
<link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="extensions/resizable/bootstrap-table-resizable.js"></script>

@extends('layouts.app')


<!-- @section('content') -->

<div class="container">
    <div class="card" style="margin-top: 100px;">
        <div class="card-header">Claims Management</div>
        <div class="card-body" style="margin-top: 10px;">

            <div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="claim-tab active" aria-current="page" href="#">Claims Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="claim-tab" href="#">Claims Vetting</a>
                    </li>
                    <li class="nav-item">
                        <a class="claim-tab" href="#">Quality Assurance</a>
                    </li>
                    <li class="nav-item">
                        <a class="claim-tab" href="#">Payment</a>
                    </li>

                    <li class="nav-item">
                        <a class="claim-tab last-tab">Paid Calims</a>
                    </li>
                </ul>

            </div>
            <!-- Static Table Start -->
            <div class="sparkline13-graph">
                <div class="datatable-dashv1-list custom-datatable-overright">
                    <div id="toolbar">
                        <select class="form-control">
                            <option value="">Export Basic</option>
                            <option value="all">Export All</option>
                            <option value="selected">Export Selected</option>
                        </select>
                    </div>
                    <table class="table table-striped table-condensed table-hover table-sm table-responsive-sm mx-auto" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="false" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-advanced-search="true" data-export-footer="true" data-show-button-icons="true" data-buttons-prefix="btn-sm btn" data-export-types="['pdf', 'doc', 'excel', 'csv' , 'json', 'xml', 'png', 'txt', 'sql']">
                        <thead>
                            <tr class="table-info">

                                <th data-field="name" width="30.6%">Provider Name</th>
                                <th data-field="claims" width="16.6%">Number of Claims</th>
                                <th data-field="amount" align="right" width="16.6%">Total Claims Amount</th>
                                <th data-field="month" width="18.6%">Month of Claim</th>
                                <th data-field="action" width="16.6%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($claims as $claim)
                            <tr>
                                <td style="padding:5px" width="30.6%">&nbsp; {{$claim->hcp_name}}</td>
                                <td style="padding:5px" width="16.6%">&nbsp; {{$claim->ID}}</td>
                                <td style="padding:5px" align="right" width="16.6%">&nbsp; {{ number_format($claim->amt,2) }}</td>
                                <td style="padding:5px" width="18.6%">&nbsp; {{$claim->month}} {{$claim->year}}</td>
                                <td style="padding:5px" width="16.6%" class="datatable-ct" style="text-align:center" align="center">
                                    &nbsp;<a href="{{ url('claimsDetail') }}?{{ http_build_query([    'hcp_name' => $claim->hcp_name,    'month' => $claim->month,    'year' => $claim->year,]) }}" class="btn btn-sm btn-success" title="CLICK HERE TO OPEN DETAILS FOR VETTING"> <i class="fa fa-angle-double-down" style="font-size:19px"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
            <!-- Static Table End -->

        </div>
    </div>
</div>


<!-- @endsection  -->

@push('scripts')
<!-- data table JS
      ============================================ -->
<script src="js/data-table/bootstrap-table.js"></script>
<script src="js/data-table/tableExport.js"></script>
<script src="js/data-table/data-table-active.js"></script>
<script src="js/data-table/bootstrap-table-editable.js"></script>
<script src="js/data-table/bootstrap-editable.js"></script>
<script src="js/data-table/bootstrap-table-resizable.js"></script>
<script src="js/data-table/colResizable-1.5.source.js"></script>
<script src="js/data-table/bootstrap-table-export.js"></script>

@endpush