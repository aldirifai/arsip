











































































































































































































































































































@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                    <div class="card-body text-center">
                        <img src="{{ url('logo.png') }}" width="30%" class="mb-3">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <hr>
                        <h1>Sistem Arsip Legalisir</h1>
                        <h5>Dinas Pendidikan Kabupaten Gresik</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
