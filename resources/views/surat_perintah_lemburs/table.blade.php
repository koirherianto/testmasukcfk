<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center mb-2">
            <h5 class="card-title">
                Surat Perintah Lembur
            </h5>
        <div class="ms-auto">
            <div class="dropdown">
                @can('suratPerintahLembur.create')
                <a href="{{ route('suratPerintahLemburs.create') }}" class="btn btn-primary float-right"> Tambah Data </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="table-responsive">
        @if ($user->hasRole('administrasi'))
        <form action="{{ route('suratPerintahLemburs.index') }}" method="GET" class="mb-2">
            <div>
                <label for="department">Filter by Department:</label>
                <select name="department" id="department">
                    <option value="">All Departments</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <div>
                <label for="status">Filter by Status:</label>
                <select name="statuss" id="statuss">
                    <option value="">All Statuses</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="revisi">Revisi</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                    <option value="draft">Draft</option>
                </select>
            </div>

            <div>
                <label for="start_date">Dari:</label>
                <input type="date" name="start_date" id="start_date">
            </div>
        
            <div>
                <label for="end_date">Sampai:</label>
                <input type="date" name="end_date" id="end_date">
            </div>
            
            <div>
                <button type="submit">Apply Filter</button>
            </div>
        </form>
        
        @endif
        <table id="data-table" class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Status</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Total Jam Lembur</th>
                <th>Alasan</th>
                @if (Auth::user()->hasRole('manager'))
                    <th class="no-print">Aksi</th>
                @endIf
                @if (Auth::user()->hasRole('administrasi'))
                    <th class="no-print">Aksi</th>
                @endIf
                @if (Auth::user()->hasRole('supervisor'))
                    <th colspan="1" class="no-print">Action</th>
                @endIf
                    <th class="no-print">Alur</th>
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
                    <td>{{ $suratPerintahLembur->alasan }}</td>
                    @if (Auth::user()->hasRole('manager') && $suratPerintahLembur->splStatusLatest->status == 'menunggu')
                        <td><a href="{{ route('spl.tanggapi', $suratPerintahLembur->id) }}" class="btn btn-success"> Tanggapi </a></td>
                    @elseif (Auth::user()->hasRole('supervisor') && ($suratPerintahLembur->splStatusLatest->status == 'menunggu' || $suratPerintahLembur->splStatusLatest->status == 'revisi'))
                    <td class="no-print">
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
                        <td class="no-print"></td>
                    @endIf
                    <td> <a href="{{ route('suratPerintahLemburs.timeline', $suratPerintahLembur->id) }}" class="no-print btn btn-primary p-2">Timeline</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
