@@extends('layouts.master')

@@section('title')
    @if($config->options->localized)
    @@lang('crud.create') @@lang('models/{!! $config->modelNames->camelPlural !!}.singular')
    @else
    Create {{ $config->modelNames->humanPlural }}
    @endif
@@endsection

@@section('page-title')
    
@if($config->options->localized)
    @@lang('crud.create') @@lang('models/{!! $config->modelNames->camelPlural !!}.singular')
    @else
    Create {{ $config->modelNames->humanPlural }}
    @endif
@@endsection

@@section('body')
    <body>
@@endsection

@@section('content')

    @@include('adminlte-templates::common.errors')

    <div class="card">

        @{!! Form::open(['route' => '{{ $config->prefixes->getRoutePrefixWith('.') }}{{ $config->modelNames->camelPlural }}.store']) !!}

        <div class="card-body">

            <div class="row">
                @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.fields')
            </div>

        </div>

        <div class="card-footer">
            @{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.index') }}" class="btn btn-default">@if($config->options->localized) @@lang('crud.cancel') @else Cancel @endif</a>
        </div>

        @{!! Form::close() !!}

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
    