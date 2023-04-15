<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.css" integrity="sha512-yU7+yXTc4VUanLSjkZq+buQN3afNA4j2ap/mxvdr440P5aW9np9vIr2JMZ2E5DuYeC9bAoH9CuCR7SJlXAa4pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/> -->
<link rel="stylesheet" href="{{ asset('css/claims.css')}}">
<link 
  href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
<!-- normalize CSS
  ============================================ -->
<link rel="stylesheet" href="{{ asset('css/data-table/bootstrap-table.css') }} ">
<link rel="stylesheet" href="{{ asset('css/data-table/bootstrap-editable.css') }}">



@extends('layouts.app')
@section('content')
    
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
                            data-search="true" data-show-columns="true" data-show-pagination-switch="true"
                            data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true"
                            data-cookie="true" data-cookie-id-table="saveId" data-show-export="true"
                            data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th data-field="sn" width="7%"><a href = "{{ url('claims-summary') }}" title="CLICK HERE TO RETURN TO REGISTER"><i  class="fa fa-reply-all"></i></a> &nbsp;S/No</th>
                                    <th data-field="date" width="6.5%">Date of Claim</th>
                                    <th data-field="ecode" width="12.5%">Enrollee Code</th>
                                    <th data-field="ename" width="12.5%">Enrollee Name</th>

                                    <th data-field="hcp" width="12.5%">Provider Name</th>
                                    <th data-field="auth" width="12.5%">Authorization Code</th>
                                    <th data-field="diag" width="12.5%">Diagnosis</th>
                                    <th data-field="amt" width="12.5%">Claim Amount</th>
                                    <th data-field="month" width="11.5%">Month Of Claim</th>

                                    <th data-field="action" width="6.6%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                               $i = 0; 
                              ?>
                              @foreach($claims as $claim)
                              <?php
                               $i = $i +1; 
                              ?>
                                <tr>
                                    <td style="padding:5px" width="7%">{{$i}}</td>
                                    <td style="padding:5px" width="6.5%"> {{$claim->entry_date}}</td>
                                    <td style="padding:5px" width="12.5%"> {{$claim->enrollee_code}}</td>
                                    <td style="padding:5px" width="12.5%"> {{$claim->enrollee_name}}</td>
                                    <td style="padding:5px" width="12.5%"> {{$claim->hcp_name}}</td>
                                    <td style="padding:5px" width="12.5%"> {{$claim->authorization_code}}</td>
                                    <td style="padding:5px" width="12.5%"> {{$claim->diagnosis}}</td>
                                    <td style="padding:5px" width="12.5%"> {{$claim->claim_amount}}</td>

                                    <td style="padding:5px" width="12.5%"> {{$claim->month}} {{$claim->year}}</td>
                                    <td style="padding:5px" width="6.6%" class="datatable-ct" style="text-align:center" align="center">
                                      &nbsp;<a href="{{ url('claims') }}?{{ http_build_query([    'hcp_name' => $claim->hcp_name,    'month' => $claim->month,    'year' => $claim->year,]) }}" class="btn btn-sm btn-success" title="CLICK HERE TO OPEN DETAILS FOR VETTING"> <i class="fa fa-angle-down" style="font-size:19px"></i></a></div> 
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
    
@endsection 

 @push('scripts')
    -->
    <!-- data table JS
      ============================================ -->
    <script src="{{ asset('js/data-table/bootstrap-table.js') }}"></script>
    <script src="{{ asset('js/data-table/tableExport.js') }}"></script>
    <script src="{{ asset('js/data-table/data-table-active.js') }}"></script>
    <script src="{{ asset('js/data-table/bootstrap-table-editable.js') }}"></script>
    <script src="{{ asset('js/data-table/bootstrap-editable.js') }}"></script>
    <script src="{{ asset('js/data-table/bootstrap-table-resizable.js') }}"></script>
    <script src="{{ asset('js/data-table/colResizable-1.5.source.js') }}"></script>
    <script src="{{ asset('js/data-table/bootstrap-table-export.js') }}"></script>

    <!--
@endpush 
