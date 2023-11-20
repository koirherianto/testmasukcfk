@extends('layouts.master')

@section('css')
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
@endsection

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
    
    {{-- apexcharts --}}
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    {{-- dashboard-sales.init.js --}}
    <script src="{{ URL::asset('build/js/pages/dashboard-sales.init.js') }}"></script>
    {{-- App js --}}
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    
@endsection
