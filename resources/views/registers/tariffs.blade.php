<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/claims.css')}}">
<!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
<!-- normalize CSS
  ============================================ -->
<link rel="stylesheet" href="css/data-table/bootstrap-table.css">
<link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('css/jquery.resizableColumns.css') }}">
<script src="{{ asset('js/jquery.resizableColumns.min.js') }}"></script>
<script src="extensions/resizable/bootstrap-table-resizable.js"></script>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card" style="margin-top: 100px;">
                <div class="card-header">{{ __('Tariffs') }}</div>
                <div class="card-body" style="margin-top: 10px;">
                <!--  route('tariffs.create')  -->
                   <a href="{{ route('tariffs.create') }}" class="btn btn-success">Add Tariff</a>
                    <div class="table-responsive">
                      <div id="toolbar">
                        <select class="form-control">
                            <option value="">Export Basic</option>
                            <option value="all">Export All</option>
                            <option value="selected">Export Selected</option>
                        </select>
                      </div>
                      <table class="table resizable table-striped table-condensed table-hover table-sm table-responsive-sm mx-auto" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="false" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-advanced-search="true" data-export-footer="true" data-show-button-icons="true" data-buttons-prefix="btn-sm btn" data-export-types="['pdf', 'doc', 'excel', 'csv' , 'json', 'xml', 'png', 'txt', 'sql']">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Sub Category</th>
                                    <th>Price</th>
                                    <th>Provider</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tariffs as $tariff)
                                    <tr>
                                        <td>{{ $tariff->type }}</td>
                                        <td>{{ $tariff->category }}</td>
                                        <td>{{ $tariff->name }}</td>
                                        <td>{{ $tariff->sub_category }}</td>
                                        <td>{{ $tariff->price }}</td>
                                        <td>{{ $tariff->provider }}</td>
                                        <td>{{ $tariff->created_at }}</td>
                                        <td>{{ $tariff->updated_at }}</td>
                                        <td>
                                            <a href=" {{route('tariffs.show', $tariff)}} " class="btn btn-sm btn-primary">View</a>
                                            <a href=" {{route('tariffs.edit', $tariff)}} " class="btn btn-sm btn-success">Edit</a>
                                            <form action="{{route('tariffs.destroy', $tariff) }}" method="POST" class="d-inline">
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
            </div>
        </div>
    </div>
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
<script>
  $(function() {
    $('.resizable').resizableColumns();
  });
</script>

@endpush