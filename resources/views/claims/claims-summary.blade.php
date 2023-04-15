{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

{{-- <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'> --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.css" integrity="sha512-yU7+yXTc4VUanLSjkZq+buQN3afNA4j2ap/mxvdr440P5aW9np9vIr2JMZ2E5DuYeC9bAoH9CuCR7SJlXAa4pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/claims.css')}}">

<!-- normalize CSS
  ============================================ -->
<link rel="stylesheet" href="css/data-table/bootstrap-table.css">
<link rel="stylesheet" href="css/data-table/bootstrap-editable.css">


<style>

/* .btn-default {
  background-color: rgb(166, 43, 43) !important;
 } */
 /* .btn-default  i{
  color: aliceblue !important;
  background-color: aliceblue !important;
  border-color: rgb(0, 255, 123) !important;
  caret-color: blue !important;
 }
select{
  border-color: #000 !important; 
} */
</style>

@extends('layouts.app')
<!-- @section('content')
    -->
    <div class="container">
        <div class="card" style="margin-top: 100px;">
            <div class="card-header">Claims Management</div>
            <div class="card-body" style="margin-top: 10px;">

                <!-- Static Table Start -->
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright">
                        <div id="toolbar">
                            <select class="form-control">
                                <option value="">Export Basic</option>
                                <option value="all">Export All</option>
                                <option hidden value="selected">Export Selected</option>
                            </select>
                        </div>
                        <table class="table sparkle-table" id="table" data-toggle="table" data-pagination="true"
                            data-search="true" data-show-columns="true" data-show-pagination-switch="false"
                            data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true"
                            data-cookie="true" data-cookie-id-table="saveId" data-show-export="true"
                            data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th data-field="date" width="16.6%">Date of Claim</th>
                                    <th data-field="name" width="16.6%">Provider Name</th>
                                    <th data-field="claims" width="16.6%">Number of Claims</th>
                                    <th data-field="amount" width="16.6%">Total Claims Amount</th>
                                    <th data-field="month" width="16.6%">Month of Claim</th>
                                    <th data-field="action" width="16.6%"></th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($claims as $claim)
                                <tr>
                                    <td width="16.6%">{{$claim->entry_date}}</td>
                                    <td width="16.6%">{{$claim->hcp_name}}</td>
                                    <td width="16.6%">{{$claim->ID}}</td>
                                    <td width="16.6%">{{$claim->amt}}</td>
                                    <td width="16.6%">{{$claim->month}} {{$claim->year}}</td>
                                    <td width="16.6%" class="datatable-ct" style="text-align:center" align="center">
                                      &nbsp;<a href="{{ url('claims', [$claim->hcp_name, $claim->month, $claim->year]) }}" class="btn btn-sm btn-success" title="CLICK HERE TO OPEN DETAILS FOR VETTING"> <i class="fa fa-angle-down" style="font-size:19px"></i></a></div> 
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
    <!--
@endsection -->

 @push('scripts')
    -->
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

    <!--
@endpush 
