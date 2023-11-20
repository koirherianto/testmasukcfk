@@extends('layouts.master')

@@section('title')
    @if($config->options->localized)
    @@lang('models/{!! $config->modelNames->camelPlural !!}.singular') @@lang('crud.detail')
    @else
    {{ $config->modelNames->human }} Details
    @endif
@@endsection

@@section('page-title')
    
@if($config->options->localized)
    @@lang('models/{!! $config->modelNames->camelPlural !!}.singular') @@lang('crud.detail')
    @else
    {{ $config->modelNames->human }} Details
@endif
@@endsection

@@section('body')
    <body>
@@endsection

@@section('content')

        <div class="card">
            <div class="card-body">
                <div class="row">
                    @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.show_fields')
                </div>
            </div>
            <a class="btn btn-default" href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural  !!}.index') }}">
                @if($config->options->localized)
@@lang('crud.back')
                @else
Back
                @endif
</a>
        </div>

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
    
