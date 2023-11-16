<div class="card">
    <div class="card-body">
    <div class="d-flex flex-wrap align-items-center mb-2">
        <h5 class="card-title">
            @if($config->options->localized)
                @@lang('models/{{ $config->modelNames->camelPlural }}.plural')
            @else
                {{ $config->modelNames->humanPlural }}
            @endif
            </h5>
        <div class="ms-auto">
            <div class="dropdown">
                {{-- <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text-muted font-size-12">Sort By: </span> <span class="fw-medium">
                        Monthly<i class="mdi mdi-chevron-down ms-1"></i></span>
                </a> --}}

                <a class="btn btn-primary float-right"
                href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.create') }}">
                       @if($config->options->localized)
                       @@lang('crud.add_new')
                        @else
                        Tambah Data
                        @endif
                        </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item" href="#">Weekly</a>
                    <a class="dropdown-item" href="#">Monthly</a>
                    <a class="dropdown-item" href="#">Yearly</a>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="{{ $config->modelNames->dashedPlural }}-table" class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
            <thead>
            <tr>
                {!! $fieldHeaders !!}
                @if($config->options->localized)
                                <th colspan="3">@lang('crud.action')</th>
                @else
                                <th colspan="3">Action</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @@foreach(${{ $config->modelNames->camelPlural }} as ${{ $config->modelNames->camel }})
                <tr>
                    {!! $fieldBody !!}
                    <td  style="width: 120px">
                        @{!! Form::open(['route' => ['{{ $config->prefixes->getRoutePrefixWith('.') }}{{ $config->modelNames->camelPlural }}.destroy', ${{ $config->modelNames->camel }}->{{ $config->primaryName }}], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.show', [${!! $config->modelNames->camel !!}->{!! $config->primaryName !!}]) }}"
                               class='btn btn-primary btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.edit', [${!! $config->modelNames->camel !!}->{!! $config->primaryName !!}]) }}"
                               class='btn btn-warning btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            @{!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        @{!! Form::close() !!}
                    </td>
                    <td>
                        <div class="dropdown">
                            <a class="text-muted dropdown-toggle font-size-18" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Print</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @@endforeach
            </tbody>
        </table>
    </div>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            {!! $paginate !!}
        </div>
    </div>
</div>
