@extends('template.layout')

@section('container')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#6c5ce7'
            });
        </script>
    @endif
    @if (session('failed'))
        <script>
            Swal.fire({
                icon: 'error',
                text: '{{ session('failed') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#6c5ce7'
            });
        </script>
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="index.html" class="link"><i
                                        class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produk</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Produk</h1>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <div class="p-4 text-end">
                                    <a href=" " type="button"
                                        class="btn btn-primary">Tambah Produk</a>
                                </div>
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"></th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                        <tr>
                                            <th scope="row">1</th>
                                            <td><img src=" " width="100"></td>
                                            <td>Jelly</td>
                                            <td>Rp. 15.000</td>
                                            <td>150</td>
                                            <td>
                                                <div class="text-center">
                                                    <a href=" "
                                                        type="button" class="btn btn-warning update-edit-btn me-2"
                                                        data-id="id" data-name="name"
                                                        data-price="price"
                                                        data-image="image"
                                                        data-stock="stock}" data-bs-toggle="modal">Edit</a>
                                                    <button type="button" class="btn btn-info update-stok-btn me-2"
                                                        data-id="id" data-name="name"
                                                        data-stock="stock" data-bs-toggle="modal"
                                                        data-bs-target="#updateStokModal">Edit Stok</button>
                                                    <form action=" "
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateStokModal" tabindex="-1" aria-labelledby="updateStokModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStokModalLabel">Edit Stok Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateStokForm" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="produk_id" name="produk_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="name" name="name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>




















































    </script>
@endsection
