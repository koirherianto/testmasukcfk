<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center mb-2">
            <h5 class="card-title">
                Dapartemen
            </h5>
        <div class="ms-auto">
            <div class="dropdown">
                @can('dapartemen.index')
                <a href="{{ route('dapartemens.create') }}" class="btn btn-primary float-right"> Tambah Data </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
            <thead>
            <tr>
                <th>Name</th>
                <th>Detail</th>
                <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($dapartemens as $dapartemen)
                <tr>
                    <td>{{ $dapartemen->name }}</td>
                    <td>{{ $dapartemen->detail }}</td>
                    <td style="width: 120px">
                        {!! Form::open(['route' => ['dapartemens.destroy', $dapartemen->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('dapartemen.index')
                            <a href="{{ route('dapartemens.show', [$dapartemen->id]) }}" class='btn btn-primary btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            @endcan
                            @can('dapartemen.edit')
                            <a href="{{ route('dapartemens.edit', [$dapartemen->id]) }}" class='btn btn-warning btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            @endcan
                            @can('dapartemen.destroy')
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            @endcan
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $dapartemens])
        </div>
    </div>
</div>
