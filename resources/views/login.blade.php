<!DOCTYPE html>

<html lang="en">


<head>

    @include('layout.partials.head')

</head>


<body style="background: #F4F5F7;">

    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper">

            <main class="form-signin m-auto">
                <form action="/login" method="post">
                    @csrf
                    <div class="text-center">
                        <h1>Aplikasi Logistik</h1>
                        <img class="mb-4" src="/images/logo.png" alt="logo">
                    </div>

                    @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="username" placeholder="Masukkan Username" autofocus value="{{ old('username') }}">
                        <label for="username">Masukkan Username</label>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Masukkan Password">
                        <label for="password">Masukkan Password</label>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary w-50" type="submit">Masuk</button>
                    </div>
                </form>
            </main>

            <!-- content-wrapper ends -->


            <!-- main-panel ends -->

        </div>

        <!-- page-body-wrapper ends -->

    </div>

    <!-- container-scroller -->

    @include('layout.partials.footer-scripts')

</body>

</html>