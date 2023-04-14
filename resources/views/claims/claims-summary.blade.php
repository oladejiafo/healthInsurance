
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


<link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.css" integrity="sha512-yU7+yXTc4VUanLSjkZq+buQN3afNA4j2ap/mxvdr440P5aW9np9vIr2JMZ2E5DuYeC9bAoH9CuCR7SJlXAa4pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs5/2.3.6/buttons.bootstrap5.min.js" integrity="sha512-g8uRKSKu8UxZQQYEylx7vAwocB3cxHhGOafAN+h054+yLpyVvGc7IconLr7wo/7C/G+BdVo6FTM5xQxLyNnSuw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs5/2.3.6/buttons.bootstrap5.css" integrity="sha512-j7aUBSc5y//dFRBmR0mI5TPfSQs1L6t1sAiKqkoz8Od0FyZWGUA8qz+UXFVR740t2xIaqHakOA3vd/tscZe/jw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-select-bs5/1.6.2/select.bootstrap5.min.js" integrity="sha512-uvHET38LwzI2+7icnqcJzaVsIgPqukHqEDjpjAi8MfBzaUCaEJJ/P9laepfQBU1DuEwvMmIlH7LkxoKYFbetPw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-select-bs5/1.6.2/select.bootstrap5.css" integrity="sha512-N74eU0onpabU6KNW2ShXslYNJnoKf0iLFucife6BvgtOmTAYELsvKteItub2Utl6vuCMxn1zrBfousm0M3jEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/claims.css')}}">

    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">


<style>
  table{
    width:100%;
  }
  thead {
    background-color: #fcfcfc;
    font-size:14px;

  }
  th{
    width:12.5%;
  }
  td{
    width: 12.5%;
  }
  .glyphicon {
    background-color: #000 !important;
  }
 i {
    color: #000 !important;
 }
</style>

@extends('layouts.app')
<!-- @section('content') -->
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
                                        <table class="table sparkle-table" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="false" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                            <thead>
                                                <tr>
                                                    <th data-field="code" width="12.5%">HCP Code</th>
                                                    <th data-field="name" width="12.5%">HCP Name</th>
                                                    <th data-field="location" width="12.5%">Location</th>
                                                    <th data-field="phone" width="12.5%">Phone</th>
                                                    <th data-field="email" width="12.5%">email</th>
                                                    <th data-field="address" width="12.5%">Address</th>
                                                    <th data-field="tariff" width="12.5%">Tariff Type</th>
                                                    <th data-field="action" width="12.5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
  
        <tr>
          <td width="12.5%"></td>
          <td width="12.5%"></td>
          <td width="12.5%"></td>
          <td width="12.5%"></td>
          <td width="12.5%"></td>
          <td width="12.5%"></td>
          <td width="12.5%"></td>
          <td width="12.5%" class="datatable-ct">

        </td>
        </tr>

         </tbody>
                                         </table>
                                    </div>
                                </div>
            <!-- Static Table End -->

            </div>
        </div>
    </div>
<!-- @endsection -->
 
<!-- @push('scripts') -->
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

<!-- @endpush -->