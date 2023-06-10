@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Profil Admin</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <img style="max-width: 40%;" class="img-md rounded-circle img-thumbnail mx-auto d-block mb-3"
                        src="/images/faces/anon.jpg" alt="Profile image">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nama</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">Johnatan Smith</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Handphone</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">(097) 234-5678</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Alamat</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Mulai Kerja</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">01 Juli 2021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection