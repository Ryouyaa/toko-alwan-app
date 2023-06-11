@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Ubah Sandi</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Ubah Sandi</h4>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="/ubah-sandi" method="post" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="passwordLama">{{ __('Password') }}</label>
                            <input name="passwordLama" type="password"
                                class="form-control @error('passwordLama') is-invalid @enderror" id="passwordLama"
                                placeholder="Masukkan password lama">
                            @error('passwordLama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passwordBaru">{{ __('Password Baru') }}</label>
                            <input name="passwordBaru" type="password"
                                class="form-control @error('passwordBaru') is-invalid @enderror" id="passwordBaru"
                                placeholder="Masukkan password baru">
                            @error('passwordBaru')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="konfirmasiPassword">{{ __('Konfirmasi Password') }}</label>
                            <input name="passwordBaru_confirmation" type="password" class="form-control @error('konfirmasiPassword') is-invalid @enderror"
                                id="konfirmasiPassword" placeholder="Masukkan kembali password baru">
                                @error('konfirmasiPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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