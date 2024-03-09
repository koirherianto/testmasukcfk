<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center mb-2">
            <h5 class="card-title">
                Karyawan
            </h5>
        <div class="ms-auto">
            <div class="dropdown">
                @can('karyawan.index')
                <a href="{{ route('karyawans.create') }}" class="btn btn-primary float-right"> Tambah Karyawan</a>
                @endcan
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
            <thead>
            <tr>
                <th>Name</th>
                <th>Dapartement</th>
                <th>NIK</th>
                <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($karyawans as $karyawan)
                <tr>
                    <td>{{ $karyawan->name }}</td>
                    <td>{{ $karyawan->dapartement->name }}</td>
                    <td>{{ $karyawan->nik }}</td>
                    <td style="width: 120px">
                        {!! Form::open(['route' => ['karyawans.destroy', $karyawan->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('karyawan.index')
                            <a href="{{ route('karyawans.show', [$karyawan->id]) }}" class='btn btn-primary btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            @endcan
                            @can('karyawan.edit')
                            <a href="{{ route('karyawans.edit', [$karyawan->id]) }}" class='btn btn-warning btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            @endcan
                            @can('karyawan.destroy')
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
            @include('adminlte-templates::common.paginate', ['records' => $karyawans])
        </div>
    </div>
</div>
