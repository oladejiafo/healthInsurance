@extends('layouts.app')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@section('content')
    <div class="card" style="margin:15px; margin-top: 100px; padding:30px">
        <div class="card-header"><h1>Create Claim</h1></div>
        <form action="{{ route('storeClaims') }}" method="POST">
            @csrf
            <div class="row card-body">
                <div class="row card-body">
                    <div class="form-group col-sm-6 col-md-4 col-lg-4">
                        <label for="hcp_id">Provider Name</label>
                        <select name="hcp_id" id="hcp_id" class="form-control" required>
                            <option selected></option>
                            @foreach ($providers as $provider)
                                <option value="{{ $provider->id }}" >{{ $provider->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="enrollee_id">Enrollee Name</label>
                    <select name="enrollee_id" id="enrollee_id" class="form-control" required>
                        <option selected></option>
                        @foreach ($enrollees as $enrollee)
                        @php
                            $name = $enrollee->surname . ' ' . $enrollee->first_name;
                        @endphp
                            <option value="{{ $enrollee->id }}" >{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option selected></option>
                        <option value="Pending">Pending</option>
                        <option value="Vetted">Vetted</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Paid">Paid</option>
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="month">Month</label>
                    <select name="month" id="month" class="form-control" required>
                        
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ date("F", mktime(0, 0, 0, $i, 1)) }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="year">Year</label>
                    <input type="number" name="year" id="year" class="form-control" required>
                </div>
                
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="authorization_code">Authorization Code</label>
                    <input type="text" name="authorization_code" id="authorization_code" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="claim_amount">Claim Amount</label>
                    <input type="number" name="claim_amount" id="claim_amount" class="form-control" required>
                </div>
                
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="diagnosis">Diagnosis</label>
                    <input type="text" name="diagnosis" id="diagnosis" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="diagnosis2">Diagnosis 2</label>
                    <input type="text" name="diagnosis2" id="diagnosis2" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="diagnosis3">Diagnosis 3</label>
                    <input type="text" name="diagnosis3" id="diagnosis3" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="diagnosis4">Diagnosis 4</label>
                    <input type="text" name="diagnosis4" id="diagnosis4" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="treatment">Treatment</label>
                    <input type="text" name="treatment" id="treatment" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="sex">Sex</label>
                    <select name="sex" id="sex" class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" class="form-control">
                </div>
                {{-- <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="company">Company</label>
                    <input type="text" name="company" id="company" class="form-control" required>
                </div> --}}
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="requested_date">Requested Date</label>
                    <input type="date" name="requested_date" id="requested_date" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="claim_date">Claim Date</label>
                    <input type="date" name="claim_date" id="claim_date" class="form-control">
                </div>

                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="attendance_date">Attendance Date</label>
                    <input type="date" name="attendance_date" id="attendance_date" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="admission_date">Admission Date</label>
                    <input type="date" name="admission_date" id="admission_date" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="discharge_date">Discharge Date</label>
                    <input type="date" name="discharge_date" id="discharge_date" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="entry_date">Entry Date</label>
                    <input type="date" name="entry_date" id="entry_date" class="form-control">
                </div>

                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="authorized_service">Authorized Service</label>
                    <input type="text" name="authorized_service" id="authorized_service" class="form-control">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" rows="3" class="form-control"></textarea>
                </div>
            </div>
           
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('claimsDetail') }}" class="btn btn-secondary">Cancel</a>
                </div>
           
        </form>
    </div>
@endsection


<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
