<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center mb-2">
            <h5 class="card-title">
                Surat Perintah Lembur
            </h5>
        <div class="ms-auto">
            <div class="dropdown">
                @can('suratPerintahLembur.index')
                <a href="{{ route('suratPerintahLemburs.create') }}" class="btn btn-primary float-right"> Tambah Data </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Status</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Total Jam Lembur</th>
                @if (Auth::user()->hasRole('manager'))
                    <th>Aksi</th>
                @endIf
                @if (Auth::user()->hasRole('administrasi'))
                    <th>Aksi</th>
                @endIf
                @if (Auth::user()->hasRole('supervisor'))
                    <th colspan="1">Action</th>
                @endIf
                    <th>Alur</th>
                </tr>
            </thead>
            <tbody>
            @foreach($suratPerintahLemburs as $suratPerintahLembur)
                <tr>
                    <td>{{ $suratPerintahLembur->karyawan->name }}</td>
                    <td> <span class="badge {{$suratPerintahLembur->spl_status_latest_status_color}} p-2">{{ $suratPerintahLembur->spl_status_latest_status  }} </span></td>
                    <td>{{ $suratPerintahLembur->mulai->format('d-m-Y H:i') }}</td>
                    <td>{{ $suratPerintahLembur->selesai->format('d-m-Y H:i') }}</td>
                    <td>{{ $suratPerintahLembur->total_jam_lembur }}</td>
                    @if (Auth::user()->hasRole('manager') && $suratPerintahLembur->splStatusLatest->status == 'menunggu')
                        <td><a href="{{ route('spl.tanggapi', $suratPerintahLembur->id) }}" class="btn btn-success"> Tanggapi </a></td>
                    @elseif (Auth::user()->hasRole('supervisor') && ($suratPerintahLembur->splStatusLatest->status == 'menunggu' || $suratPerintahLembur->splStatusLatest->status == 'revisi'))
                    <td>
                        <div class="dropdown">
                            <a class="text-muted dropdown-toggle font-size-18" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('suratPerintahLemburs.edit', [$suratPerintahLembur->id]) }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('suratPerintahLemburs.show', [$suratPerintahLembur->id]) }}">Detail</a>
                                {!! Form::open(['route' => ['suratPerintahLemburs.destroy', $suratPerintahLembur->id], 'method' => 'delete']) !!}
                                {!! Form::button('Delete', ['type' => 'submit', 'class' => 'dropdown-item', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </td>
                    @else
                        <td></td>
                    @endIf
                    <td> <a href="" class="btn btn-primary p-2">Timeline</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $suratPerintahLemburs])
        </div>
    </div>
</div>
