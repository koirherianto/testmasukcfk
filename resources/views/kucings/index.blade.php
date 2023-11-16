@extends('layouts.master')
@section('title')
Kucings
@endsection
@section('page-title')
Kucings
@endsection
@section('body')

<body>
@endsection
@section('content')

    @include('flash::message')

    @include('kucings.table')

@endsection
@section('scripts')
    
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/dashboard-sales.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    
@endsection

