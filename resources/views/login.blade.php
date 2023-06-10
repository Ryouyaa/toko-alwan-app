<!DOCTYPE html>

<html lang="en">


<head>

    @include('layout.partials.head')

</head>


<body style="background: #F4F5F7;">

    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper">

            <main class="form-signin m-auto">
                <form action="/">
                    <div class="text-center">
                        <h1>Aplikasi Logistik</h1>
                        <img class="mb-4" src="/images/logo.png" alt="logo">
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary w-50 py-2" type="submit">Masuk</button>
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