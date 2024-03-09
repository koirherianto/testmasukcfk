@extends('layouts.master')

@section('title')
    Create Surat Perintah Lemburs
@endsection

@section('page-title')
Create Surat Perintah Lemburs
@endsection

@section('body')
    <body>
@endsection

@section('content')

    @include('adminlte-templates::common.errors')
    @include('flash::message')

    <div class="card">

        {!! Form::open(['route' => 'suratPerintahLemburs.store']) !!}

        <div class="card-body">

            <div class="row">
                @include('surat_perintah_lemburs.fields')
            </div>

        </div>

        <div class="card-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('suratPerintahLemburs.index') }}" class="btn btn-default"> Cancel </a>
        </div>

        {!! Form::close() !!}

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
    