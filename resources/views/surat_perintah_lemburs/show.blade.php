@extends('layouts.master')

@section('title')
        Surat Perintah Lembur Details
    @endsection

@section('page-title')
    
    Surat Perintah Lembur Details
@endsection

@section('body')
    <body>
@endsection

@section('content')

        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('surat_perintah_lemburs.show_fields')
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('suratPerintahLemburs.index') }}" class="btn btn-default"> Cancel </a>
            </div>
        </div>

@endsection

@section('scripts')
    
    {{-- apexcharts --}}
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    {{-- dashboard-sales.init.js --}}
    <script src="{{ URL::asset('build/js/pages/dashboard-sales.init.js') }}"></script>
    {{-- App js --}}
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    
@endsection
    
