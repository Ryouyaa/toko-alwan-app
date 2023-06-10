@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Ubah Sandi</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Ubah Sandi</h4>
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="passwordLama">Password Lama</label>
                            <input type="password" class="form-control" id="passwordLama" placeholder="Masukkan password lama" />
                        </div>
                        <div class="form-group">
                            <label for="passwordBaru">Password Baru</label>
                            <input type="password" class="form-control" id="passwordBaru" placeholder="Masukkan password baru" />
                        </div>
                        <div class="form-group">
                            <label for="konfirmasiPassword">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="konfirmasiPassword" placeholder="Masukkan kembali password baru" />
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection