<div class="card">
    <div class="card-body">
    <div class="d-flex flex-wrap align-items-center mb-2">
        <h5 class="card-title">
                            Kucings
                        </h5>
        <div class="ms-auto">
            <div class="dropdown">
                <a class="btn btn-primary float-right" href="{{ route('kucings.create') }}">
                    Tambah Data
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="kucings-table" class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Penjelasa</th>
                <th>Is Boy</th>
                 <th colspan="3">Action</th>
                            </tr>
            </thead>
            <tbody>
            @foreach($kucings as $kucing)
                <tr>
                    <td>{{ $kucing->nama }}</td>
                    <td>{{ $kucing->tanggal_lahir }}</td>
                    <td>{{ $kucing->penjelasa }}</td>
                    <td>{{ $kucing->is_boy }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['kucings.destroy', $kucing->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('kucings.show', [$kucing->id]) }}"
                               class='btn btn-primary btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('kucings.edit', [$kucing->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $kucings])
        </div>
    </div>
</div>


<!-- Tempatkan tabel di sini -->

<div class="card">
    <div class="card-body">
        <div class="position-relative">
            <div class="modal-button mt-2">
                <a class="btn btn-primary float-right" href="{{ route('kucings.create') }}">
                    Tambah Data
                </a>
            </div>
        </div>
        <div id="myTable"></div>
    </div>
</div>

<script>
    const grid = new gridjs.Grid({
        columns: [
            {
            name: 'ID',
            hidden: true,
        },
            "Nama",
            "Tanggal Lahir",
            "Penjelasan",
            "Is Boy",
            {
                name: "Action",
                // ${row.cells[0].data}
                formatter: (cell, row) => gridjs.html(`
                    <div class='btn-group justify-content-end'>
                        <a href="{{ route('kucings.show', ['']) }}/${row.cells[0].data}" class='btn btn-primary btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('kucings.edit', ['']) }}/${row.cells[0].data}"  class='btn btn-warning btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        <form action="@{{ route('kucings.destroy', [row.cells[0].data]) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm btn-delete">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                `),
                colspan: 3  // Set colspan to 3
            }
        ],
        search: true,
        sort: true,
        pagination: true,
        data: [
            @foreach($kucings as $kucing)
               ["{{ $kucing->id }}" ,"{{ $kucing->nama }}", "{{ $kucing->tanggal_lahir }}", "{{ $kucing->penjelasa }}", "{{ $kucing->is_boy }}"],
            @endforeach
        ],
        language: {
            'search': {
                'placeholder': 'Cari...'
            }
        },
    });

    function detailView(id) {
        window.location.href = "{{ route('kucings.show', ['']) }}/" + id;
    }

    // Render the table
    grid.render(document.getElementById("myTable"));

</script>


