
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


<link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.css" integrity="sha512-yU7+yXTc4VUanLSjkZq+buQN3afNA4j2ap/mxvdr440P5aW9np9vIr2JMZ2E5DuYeC9bAoH9CuCR7SJlXAa4pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs5/2.3.6/buttons.bootstrap5.min.js" integrity="sha512-g8uRKSKu8UxZQQYEylx7vAwocB3cxHhGOafAN+h054+yLpyVvGc7IconLr7wo/7C/G+BdVo6FTM5xQxLyNnSuw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs5/2.3.6/buttons.bootstrap5.css" integrity="sha512-j7aUBSc5y//dFRBmR0mI5TPfSQs1L6t1sAiKqkoz8Od0FyZWGUA8qz+UXFVR740t2xIaqHakOA3vd/tscZe/jw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-select-bs5/1.6.2/select.bootstrap5.min.js" integrity="sha512-uvHET38LwzI2+7icnqcJzaVsIgPqukHqEDjpjAi8MfBzaUCaEJJ/P9laepfQBU1DuEwvMmIlH7LkxoKYFbetPw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-select-bs5/1.6.2/select.bootstrap5.css" integrity="sha512-N74eU0onpabU6KNW2ShXslYNJnoKf0iLFucife6BvgtOmTAYELsvKteItub2Utl6vuCMxn1zrBfousm0M3jEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/claims.css')}}">
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card" style="margin-top: 100px;">
            <div class="card-header">Claims Management</div>
            <div class="card-body" style="margin-top: 10px;">
                {{ $dataTable->table([], true) }}
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
<!-- <link rel="stylesheet" href=""> -->
    {{ $dataTable->scripts() }}
@endpush