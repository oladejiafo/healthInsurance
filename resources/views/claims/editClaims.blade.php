
@extends('layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@section('content')
<div class="card" style="margin:15px; margin-top: 100px; padding:30px">
    <div class="card-header"><h1>Edit Claim</h1></div>
    <form action="{{ route('storeClaims', $claim->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row card-body">
            <div class="form-group col-sm-6 col-md-4 col-lg-4">
                <label for="hcp_id">Provider Name</label>
                <select name="hcp_id" id="hcp_id" class="form-control" required>
                    @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}" @if ($claim->hcp_id == $provider->id) selected @endif>{{ $provider->name }}</option>
                    @endforeach
                </select>
            </div>
            
        <div class="form-group col-sm-6 col-md-4 col-lg-4">
            <label for="enrollee_id">Enrollee Name</label>
            <select name="enrollee_id" id="enrollee_id" class="form-control" required>
                @foreach ($enrollees as $enrollee)
                @php
                    $name = $enrollee->surname . ' ' . $enrollee->first_name;
                @endphp
                    <option value="{{ $enrollee->id }}" @if ($claim->enrollee_id == $enrollee->id) selected @endif>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-6 col-md-4 col-lg-4">
            <label for="pay_date">Pay Date</label>
            <input type="date" name="pay_date" id="pay_date" class="form-control" value="{{ $claim->pay_date }}" required>
        </div>
    </div>
    <div class="row">
        <!-- Add other form fields here -->

        <div class="form-group col-sm-6 col-md-4 col-lg-4">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('claimsDetail') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
</div>
@endsection
