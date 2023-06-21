@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
  <main class="flex-shrink-0">
    <div class="container">
      @auth
      <h2 class="welcome-text">Selamat Datang, <span class="text-black fw-bold">{{ auth()->user()->name }}</span></h2>
      @endauth
    </div>
  </main>
</div>
@endsection