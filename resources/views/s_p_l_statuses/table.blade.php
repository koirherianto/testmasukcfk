<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center mb-2">
            <h5 class="card-title">
                S P L Statuses 
            </h5>
        <div class="ms-auto">
            <div class="dropdown">
                @can('sPLStatus.index')
                <a href="{{ route('sPLStatuses.create') }}" class="btn btn-primary float-right"> Tambah Data </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
            <thead>
            <tr>
                <th>Approved By</th>
                <th>Surat Perintah Lembur Id</th>
                <th>Status</th>
                <th>Message</th>
                <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($sPLStatuses as $sPLStatus)
                <tr>
                    <td>{{ $sPLStatus->approved_by }}</td>
                    <td>{{ $sPLStatus->surat_perintah_lembur_id }}</td>
                    <td>{{ $sPLStatus->status }}</td>
                    <td>{{ $sPLStatus->message }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="text-muted dropdown-toggle font-size-18" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('sPLStatuses.edit', [$sPLStatus->id]) }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('sPLStatuses.show', [$sPLStatus->id]) }}">Detail</a>
                                {!! Form::open(['route' => ['sPLStatuses.destroy', $sPLStatus->id], 'method' => 'delete']) !!}
                                {!! Form::button('Delete', ['type' => 'submit', 'class' => 'dropdown-item', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $sPLStatuses])
        </div>
    </div>
</div>
