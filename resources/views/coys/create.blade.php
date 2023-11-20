@extends('layouts.master')

@section('title')
        Create Coys
    @endsection

@section('page-title')
    
    Create Coys
    @endsection

@section('body')
    <body>
@endsection

@section('content')


        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'coys.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('coys.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('coys.index') }}" class="btn btn-default"> Cancel </a>
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
    