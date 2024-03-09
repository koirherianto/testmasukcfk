@extends('layouts.master')

@section('title')
    Meninjau Surat Perintah Lembur
    @endsection

@section('page-title')
    
    Meninjau Surat Perintah Lembur
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

            <div class="card-body">
                {!! Form::open(['route' => ['spl.tanggapi.post', $id], 'method' => 'post']) !!}
            
                <div class="form-group">
                    {!! Form::label('message', 'Pesan:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 4, 'attributes']) !!}
                </div>
            
                <div class="form-group text-right mt-3"> 
                    <button value="disetujui" name="status" class="btn btn-success">Disetujui</button>
                    <button value="revisi" name="status" class="btn btn-dark">Revisi</button>
                    <button value="ditolak" name="status" class="btn btn-danger">Ditolak</button>
                </div>
            
                {!! Form::close() !!}
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
    
