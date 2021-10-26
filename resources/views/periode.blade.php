@extends('layouts.admin')
@section('title', 'Data Periode')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="row mt-3 mb-2">
                <ol class="col-md-10 breadcrumb mb-4 mt-4" style="padding-left:1em">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Periode</li>
                </ol>
                <div class="col-md-2">
                    <button class="btn mt-2 btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah
                        Data</button>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Periode
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Tahun</th>
                                <th colspan="2" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->tahun }}</td>
                                    <td style="width: 10%">
                                        <button class="btn btn-sm w-100 btn-warning"
                                            onclick="ubahData('{{ $item->id }}|{{ $item->tahun }}')"
                                            data-bs-toggle="modal" data-bs-target="#ubahData">Ubah
                                            Data</button>
                                    </td>
                                    <td style="width: 10%">
                                        <form action="{{ url('periode/' . $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn w-100 btn-sm btn-danger"
                                                onclick="fungsiHapus()">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('periode') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" name="tahun">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ubahData" tabindex="-1" aria-labelledby="ubahDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataLabel">Ubah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="ubahdata">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" name="tahun" id="tahun">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function ubahData(data) {
            var data = data;
            data = data.split('|');

            console.log(data);
            var url = "{{ url('periode') }}" + '/' + data[0];

            $('#ubahdata').attr('action', url);

            $('#tahun').val(data[1]);
        }
    </script>
@endsection
