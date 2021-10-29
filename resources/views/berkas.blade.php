@extends('layouts.admin')
@section('title', 'Data Berkas')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="row mt-3 mb-2">
                <ol class="col-md-10 breadcrumb mb-4 mt-4" style="padding-left:1em">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Legalisir</li>
                </ol>
                <div class="col-md-2">
                    <button class="btn mt-2 btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah
                        Data</button>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Berkas Legalisir
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="text-center">
                        <thead>
                            <tr>
                                <th>Tanggal Legalisir</th>
                                <th>Nama</th>
                                <th>Nomor Ijazah</th>
                                <th>Nama Sekolah</th>
                                <th>Periode</th>
                                <th>Jenjang</th>
                                <th colspan="3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->tanggal_legalisir }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nomor_ijazah }}</td>
                                    <td>{{ $item->nama_sekolah }}</td>
                                    <td>{{ $item->periode->tahun }}</td>
                                    <td>{{ $item->jenjang->nama_jenjang }}</td>
                                    <td style="width: 10%">
                                        <button class="btn btn-sm w-100 btn-info"
                                            onclick="lihatData('{{ $item->file_arsip }}')" data-bs-toggle="modal"
                                            data-bs-target="#lihatData">Lihat
                                            Berkas</button>
                                    </td>
                                    <td style="width: 10%">
                                        <button class="btn btn-sm w-100 btn-warning"
                                            onclick="ubahData('{{ $item->id }}|{{ $item->tanggal_legalisir }}|{{ $item->nama }}|{{ $item->nomor_ijazah }}|{{ $item->nama_sekolah }}|{{ $item->id_periode }}|{{ $item->id_jenjang }}')"
                                            data-bs-toggle="modal" data-bs-target="#ubahData">Ubah
                                            Data</button>
                                    </td>
                                    <td style="width: 10%">
                                        <form action="{{ url('berkas/' . $item->id) }}" method="POST">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('berkas') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Legalisir</label>
                            <input type="text" class="form-control datepicker" name="tanggal_legalisir"
                                value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Ijazah</label>
                            <input type="text" class="form-control" name="nomor_ijazah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" name="nama_sekolah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Periode</label>
                            <select type="text" class="form-select" name="id_periode">
                                <option>Pilih Periode</option>
                                @foreach ($periode as $item)
                                    <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenjang</label>
                            <select type="text" class="form-select" name="id_jenjang">
                                <option>Pilih Jenjang</option>
                                @foreach ($jenjang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_jenjang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">File Arsip</label>
                            <input class="form-control" type="file" name="file_arsip">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataLabel">Ubah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="ubahdata" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Legalisir</label>
                            <input type="text" class="form-control datepicker" name="tanggal_legalisir" value=""
                                id="tanggal_legalisir">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Ijazah</label>
                            <input type="text" class="form-control" name="nomor_ijazah" id="nomor_ijazah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Periode</label>
                            <select type="text" class="form-select" name="id_periode" id="id_periode" value="">
                                <option>Pilih Periode</option>
                                @foreach ($periode as $item)
                                    <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenjang</label>
                            <select type="text" class="form-select" name="id_jenjang" id="id_jenjang" value="">
                                <option>Pilih Jenjang</option>
                                @foreach ($jenjang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_jenjang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ubah File Arsip</label>
                            <input class="form-control" type="file" name="file_arsip">
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

    <div class="modal fade" id="lihatData" tabindex="-1" aria-labelledby="lihatDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lihatDataLabel">Berkas Legalisir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <embed src="" id="fileLihat" width="100%" height="500" class="embed-responsive-item"
                            type="application/pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a target="_blank" href="" class="btn btn-primary downBerkas">Download</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });

        function ubahData(data) {
            var data = data;
            data = data.split('|');

            console.log(data);
            var url = "{{ url('berkas') }}" + '/' + data[0];

            $('#ubahdata').attr('action', url);

            $('#tanggal_legalisir').val(data[1]);
            $('#nama').val(data[2]);
            $('#nomor_ijazah').val(data[3]);
            $('#nama_sekolah').val(data[4]);
            $('#id_periode').val(data[5]);
            $('#id_jenjang').val(data[6]);
        }

        function lihatData(data) {
            var url = "{{ url('arsip') }}" + '/' + data;

            $('.downBerkas').attr('href', url);
            $('#fileLihat').attr('src', url);
        }
    </script>
@endsection
