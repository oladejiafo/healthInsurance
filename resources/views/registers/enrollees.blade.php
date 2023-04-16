<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/claims.css')}}">
<!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
<!-- normalize CSS
  ============================================ -->
<link rel="stylesheet" href="css/data-table/bootstrap-table.css">
<link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="card" style="margin-top: 100px;">
                <div class="card-header">{{ __('Enrollees') }}</div>
                <div class="card-body" style="margin-top: 10px;">

                <a href="#" class="btn btn-primary mb-3">Create New</a>
                    <div class="table-responsive">
                      <div id="toolbar">
                        <select class="form-control">
                            <option value="">Export Basic</option>
                            <option value="all">Export All</option>
                            <option value="selected">Export Selected</option>
                        </select>
                      </div>
                      <table class="table table-striped table-condensed table-hover table-sm table-responsive-sm mx-auto" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="false" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-advanced-search="true" data-export-footer="true" data-show-button-icons="true" data-buttons-prefix="btn-sm btn" data-export-types="['pdf', 'doc', 'excel', 'csv' , 'json', 'xml', 'png', 'txt', 'sql']">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>HCP</th>
                    <th>Sex</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollees as $enrollee)
                    <tr>
                        <td>{{ $enrollee->id }}</td>
                        <td>{{ $enrollee->code }}</td>
                        <td>{{ $enrollee->surname }} {{ $enrollee->first_name }}</td>
                        <td>{{ $enrollee->phone }}</td>
                        <td>{{ $enrollee->address }}</td>
                        <td>{{ $enrollee->email }}</td>
                        <td>{{ $enrollee->hcp_name }}</td>
                        <td>{{ $enrollee->sex }}</td>
                        <td>{{ $enrollee->age }}</td>
                        <td>
                            <a href="#" class="btn btn-primary">View</a>
                            <a href="#" class="btn btn-success">Edit</a>
                            <form action="#" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
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