<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center mb-2">
            <h5 class="card-title">
                Coys 
                </h5>
        <div class="ms-auto">
            <div class="dropdown">
                <a class="btn btn-primary float-right" href="{{ route('coys.create') }}">
                       Tambah Data
                        </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Tinggi</th>
                <th>Penjelasan</th>
                <th >Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($coys as $coy)
                <tr>
                    <td>{{ $coy->nama }}</td>
                    <td>{{ $coy->tanggal_lahir }}</td>
                    <td>{{ $coy->tinggi }}</td>
                    <td>{{ $coy->penjelasan }}</td>
                    <td style="width: 120px">
                        {!! Form::open(['route' => ['coys.destroy', $coy->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('coys.show', [$coy->id]) }}"
                               class='btn btn-primary btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('coys.edit', [$coy->id]) }}"
                               class='btn btn-warning btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $coys])
        </div>
    </div>
</div>
