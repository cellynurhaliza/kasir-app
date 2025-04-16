@extends('template.layout')

@section('container')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="index.html" class="link"><i
                                        class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Penjualan</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-4 d-flex justify-content-between">
                                <a href=" " class="btn btn-info te">Ekspor Penjualan (.xlsx)</a>
                            </div>
                            <div class="table-responsive">
                                <table id="tabel-data" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Pelanggan</th>
                                            <th scope="col">Tanggal Penjualan</th>
                                            <th scope="col">Total Harga</th>
                                            <th scope="col">Dibuat Oleh</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>BUKAN MEMBER</td>
                                                <td>05-05-2025</td>
                                                <td>Rp. 50.000</td>
                                                <td>petugas</td>
                                                <td>
                                                    <a href="" data-bs-target="#show- "
                                                        data-bs-toggle="modal" class="btn btn-warning me-2">Lihat</a>
                                                    <a href=" "
                                                        class="btn btn-info me-2">Unduh Bukti</a>
                                                </td>
                                            </tr>
                                            <div class="modal" tabindex="-1" id="show- ">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLihat">Detail Penjualan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <small>
                                                                        <strong>Member Status :
                                                                            Member</strong><br>
                                                                        <strong>No. HP :
                                                                            088</strong><br>
                                                                        <strong>Poin Member :
                                                                            200</strong>
                                                                    </small>
                                                                </div>
                                                                <div class="col-6">
                                                                    <small>
                                                                        <strong>Bergabung Sejak :
                                                                            05 Apr 2025</strong>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 text-center mt-5">
                                                                <div class="col-3"><b>Nama Produk</b></div>
                                                                <div class="col-3"><b>Qty</b></div>
                                                                <div class="col-3"><b>Harga</b></div>
                                                                <div class="col-3"><b>Sub Total</b></div>
                                                            </div>


                                                                    <div class="row mb-1">
                                                                        <div class="col-3 text-center">
                                                                            Jelly
                                                                        </div>
                                                                        <div class="col-3 text-center">
                                                                            2
                                                                        </div>
                                                                        <div class="col-3 text-center">
                                                                            Rp. 25.000
                                                                        </div>
                                                                        <div class="col-3 text-center">
                                                                            Rp. 50.000
                                                                        </div>
                                                                    </div>


                                                            <div class="row text-center mt-3">
                                                                <div class="col-9 text-end"><b>Total</b></div>
                                                                <div class="col-3">

                                                                        <b>19.000</b>



                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <center>
                                                                    Dibuat pada : 5 apr
                                                                    <br> Oleh :
                                                                    petugas
                                                                </center>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href=" "
                                                                class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data yang tersedia"
                }
            });
        });
    </script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                text: {!! json_encode(session('error')) !!},
                confirmButtonText: 'OK',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: {!! json_encode(session('success')) !!},
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif
@endsection