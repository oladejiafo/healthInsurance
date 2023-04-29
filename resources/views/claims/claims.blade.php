<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/claims.css')}}">
<!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> -->
<link 
  href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
<!-- normalize CSS
  ============================================ -->
<link rel="stylesheet" href="css/data-table/bootstrap-table.css">
<link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="extensions/resizable/bootstrap-table-resizable.js"></script>

@extends('layouts.app')
@section('content')
    
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
                                <option hidden value="selected">Export Selected</option>
                            </select>
                        </div>
                        <table class="table  table-striped" id="table" data-toggle="table" data-pagination="true"
                            data-search="true" data-show-columns="true" data-show-pagination-switch="false"
                            data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true"
                            data-cookie="true" data-cookie-id-table="saveId" data-show-export="true"
                            data-click-to-select="true" data-toolbar="#toolbar" data-advanced-search="true" 
                            data-export-footer="true" 
                            data-export-types="['pdf', 'doc', 'excel', 'csv' , 'json', 'xml', 'png', 'txt', 'sql']">
                            <thead>
                                <tr>
                                    <th data-field="sn" width="7%"><a href = "{{ url('claimsSummary') }}" title="CLICK HERE TO RETURN TO REGISTER"><i  class="fa fa-reply-all btn-secondary"></i></a> &nbsp;S/No</th>
                                    <th data-field="date" width="6.5%">Date of Claim</th>
                                    <th data-field="ecode" width="12.5%">Enrollee Code</th>
                                    <th data-field="ename" width="12.5%">Enrollee Name</th>

                                    <th data-field="hcp" width="12.5%">Provider Name</th>
                                    <th data-field="amt" width="12.5%">Claim Amount</th>
                                    <th data-field="month" width="11.5%">Month Of Claim</th>
                                    <th data-field="auth" width="12.5%">Authorization Code</th>
                                    <th data-field="diag" width="12.5%">Diagnosis</th>

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
                                    <td style="padding:5px" width="7%">&nbsp; {{$i}}</td>
                                    <td style="padding:5px" width="6.5%">&nbsp; {{$claim->entry_date}}</td>
                                    <td style="padding:5px" width="12.5%">&nbsp; {{$claim->enrollee_code}}</td>
                                    <td style="padding:5px" width="12.5%">&nbsp; {{$claim->enrollee_name}}</td>
                                    <td style="padding:5px" width="12.5%">&nbsp; {{$claim->hcp_name}}</td>
                                    <td style="padding:5px" width="12.5%">&nbsp; {{ number_format($claim->claim_amount,2) }}</td>
                                    <td style="padding:5px" width="12.5%">&nbsp; {{$claim->month}} {{$claim->year}}</td>
                                    <td style="padding:5px" width="12.5%">&nbsp; {{$claim->authorization_code}}</td>
                                    <td style="padding:5px" width="12.5%">&nbsp; {{$claim->diagnosis}}</td>
                                    <td>
                                        <a href=" {{route('tariffs.show', $claim->id)}} " class="btn btn-sm btn-primary">View</a>
                                        <a href=" {{route('editClaims', $claim->id)}} " class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{route('claims.destroy', $claim->id) }}" method="POST" class="d-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tariff?')">Delete</button>
                                        </form>
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
