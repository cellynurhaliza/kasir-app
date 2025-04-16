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
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                        <li class="breadcrumb-item"><a href="" class="link">Penjualan</a></li>
                    </ol>
                </nav>
                <h1 class="mb-0 fw-bold">Penjualan</h1> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center container">
                            <div class="row">
                                
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card">
                                            <p hidden class="product_id"></p>
                                            <div class="bg-image">
                                                <img src="" class="w-50 mt-3"
                                                    alt="">
                                            </div>
                                            <div class="card-body">
                                                <div class="card-title mb-3"></div>
                                                <p>Stock <span class="prdct_stock"></span></p>
                                                <h6 class="mb-3 product_price"></h6>
                                                <center>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding: 0px 10px 0px 10px; cursor: pointer;"
                                                                    class="prdct_mint">
                                                                    <b>-</b>
                                                                </td>
                                                                <td style="padding: 0px 10px 0px 10px;" class="prdct_sum">0
                                                                </td>
                                                                <td style="padding: 0px 10px 0px 10px; cursor: pointer;"
                                                                    class="prdct_plus">
                                                                    <b>+</b>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </center>
                                                <p class="mt-3">
                                                    Sub Total
                                                    <b class="sub_total">Rp. 0 ,-</b>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                
                                <form action=" " method="post">
                                    @csrf
                                    @method('POST')
                                    <div id="hidden-inputs"></div>
                                    <div class="fixed-bottom bg-white border-top p-3 shadow-sm">
                                        <div class="position-absolute top-0 end-0 border-top border-warning" style="height: 3px; width: 2010px;">
                                        </div>
                                        <div class="text-end">
                                            <button id="submit-bottom" type="submit" class="btn btn-primary" style="margin-right: 560px;">Selanjutnya</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>
@endsection
