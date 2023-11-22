@extends('layouts.master')

@section('page-title')
    Coys
@endsection

@section('title')
    Coys
@endsection

@section('css')
{{-- hidupkan data table --}}
{{-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> --}} 
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
    {{-- hidupkan data table --}}
    {{-- <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });
    </script> --}}
    
@endsection

