<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center mb-2">
            <h5 class="card-title">
                Permissions 
            </h5>
        <div class="ms-auto">
            <div class="dropdown">
                @can('permission.index')
                <a class="btn btn-primary float-right" href="{{ route('permissions.create') }}">
                    Tambah Data
                </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
            <thead>
            <tr>
                <th>Name</th>
                <th>Guard Name</th>
                <th >Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td style="width: 120px">
                        {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('permission.index')
                            <a href="{{ route('permissions.show', [$permission->id]) }}"
                               class='btn btn-primary btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            @endcan
                            @can('permission.edit')
                            <a href="{{ route('permissions.edit', [$permission->id]) }}"
                               class='btn btn-warning btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            @endcan
                            @can('permission.destroy')
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
</div>
