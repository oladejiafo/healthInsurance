<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/claims.css')}}">
<!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
<!-- normalize CSS
  ============================================ -->
<link rel="stylesheet" href="{{ asset('css/data-table/bootstrap-table.css') }}">
<link rel="stylesheet" href="{{ asset('css/data-table/bootstrap-editable.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 100px;">

                    <div class="card-header">{{ __('View Tariff') }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ $tariff->type }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <input id="category" type="text" class="form-control" name="category" value="{{ $tariff->category }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $tariff->name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sub_category" class="col-md-4 col-form-label text-md-right">{{ __('Sub Category') }}</label>

                            <div class="col-md-6">
                                <input id="sub_category" type="text" class="form-control" name="sub_category" value="{{ $tariff->sub_category }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="{{ $tariff->price }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="provider" class="col-md-4 col-form-label text-md-right">{{ __('Provider') }}</label>

                            <div class="col-md-6">
                                <input id="provider" type="text" class="form-control" name="provider" value="{{ $tariff->provider }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
