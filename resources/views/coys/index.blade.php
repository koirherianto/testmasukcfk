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
    <div class="card">
        @include('coys.table')
    </div>

@endsection
@section('scripts')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/dashboard-sales.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

