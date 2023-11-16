
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
    {{-- apexcharts --}}
    @verbatim
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    @endverbatim

    {{-- dashboard-sales.init.js --}}
    @verbatim
    <script src="{{ URL::asset('build/js/pages/dashboard-sales.init.js') }}"></script>
    @endverbatim

    {{-- App js --}}
    @verbatim
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endverbatim
@@endsection

