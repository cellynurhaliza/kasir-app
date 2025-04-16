@extends('template.layout')

@section('container')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="/" class="link"><i
                                        class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item"><a href="" class="link">Penjualan</a></li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Penjualan</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{ " method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <h2>Produk yang dipilih</h2>
                                    <table style="width: 100%;">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            
                                                <tr>
                                                    <td> <br>
                                                        <small>
                                                            X
                                                            </small></td>
                                                    <td><b></b>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="shop[]"
                                                    value=" "
                                                    hidden="">
                                            
                                            <tr>
                                                <td style="padding-top: 20px; font-size: 20px;"><b>Total</b></td>
                                                <td class="tex-end" id="get_total"
                                                    style="padding-top: 20px; font-size: 20px;">
                                                    <b> </b>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="text" name="total" id="total" value=" "
                                        hidden="">
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="member" class="form-label">Member Status</label>
                                            <small class="text-danger">Dapat juga membuat member</small>
                                            <select name="member" id="member" class="form-select"
                                                onchange="memberDetect()">
                                                <option value="Bukan Member">Bukan Member</option>
                                                <option value="Member">Member</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="member-wrap" class="d-none">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12">No Telepon <small
                                                            class="text-danger">(daftar/gunakan member)</small></label>
                                                    <div class="col-md-12">
                                                        <input type="number" name="telephone"
                                                            class="form-control form-control-line "
                                                            onkeypress="if(this.value.length==13) return false;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="total_pay" class="form-label">Total Bayar</label>
                                            <input type="text" name="total_pay" id="total_pay" class="form-control"
                                                oninput="checkTotalPay()">
                                            <small id="error-message" class="text-danger d-none">Jumlah bayar
                                                kurang.</small>
                                        </div>
                                    </div>
                                    <div class="row text-end">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" id="submit-button" type="submit"
                                                disabled>Pesan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            
        </script>
    </div>
@endsection