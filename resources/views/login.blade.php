<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" />
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">


</head>

<body>
    {{-- <a href="{{ url()->previous() }}" class="btn btn-light position-absolute m-3" style="top: 0; left: 0; z-index: 1050;">
        ← Keluar
    </a> --}}
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://img.freepik.com/free-vector/privacy-policy-concept-illustration_114360-7853.jpg?t=st=1740619262~exp=1740622862~hmac=19930bbbdd5f46befe66ac33f686894f8aa173611f51aacf1de8af699bcb19f3&w=900"
                        class="img-fluid" alt="Sample image">
                </div>

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <h1 class="mb-3 fw-bold">Masuk</h1>
                        </div>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email</label>
                            <input type="email" name="email" id="form3Example3" required
                                class="form-control form-control-lg" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Kata Sandi</label>
                            <input type="password" name="password" id="form3Example4" required
                                class="form-control form-control-lg" />
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @yield('scripts')
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--
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
@endif --}}

</html>
