@extends('layouts.master')

@section('title')
    Coys
@endsection

@section('page-title')
    Coys
@endsection

@section('body')
    <body>
@endsection

@section('content')
    @include('flash::message')
    @include('coys.table')
@endsection

@section('scripts')
    
    {{-- apexcharts --}}
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    {{-- dashboard-sales.init.js --}}
    <script src="{{ URL::asset('build/js/pages/dashboard-sales.init.js') }}"></script>
    {{-- App js --}}
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    
@endsection

