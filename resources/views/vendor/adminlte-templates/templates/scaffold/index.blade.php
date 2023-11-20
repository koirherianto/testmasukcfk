
@@extends('layouts.master')

@@section('title')
    {{ $config->modelNames->humanPlural }}
@@endsection

@@section('page-title')
    {{ $config->modelNames->humanPlural }}
@@endsection

@@section('body')
    <body>
@@endsection

@@section('content')
    @@include('flash::message')
    {!! $table !!}
@@endsection

@@section('scripts')
    @verbatim
    {{-- apexcharts --}}
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    {{-- dashboard-sales.init.js --}}
    <script src="{{ URL::asset('build/js/pages/dashboard-sales.init.js') }}"></script>
    {{-- App js --}}
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endverbatim
@@endsection

