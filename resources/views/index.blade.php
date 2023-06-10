@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold">John Doe</span></h1>
            <p class="lead">Pin a footer to the bottom of the viewport in desktop browsers with this custom HTML and
                CSS. A
                fixed navbar has been added with <code class="small">padding-top: 60px;</code> on the <code
                    class="small">main &gt; .container</code>.</p>
            <p>Back to <a href="/docs/5.3/examples/sticky-footer/">the default sticky footer</a> minus the navbar.</p>
        </div>
    </main>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Line chart</h4>
            <canvas id="lineChart"></canvas>
          </div>
        </div>
      </div>
</div>

@endsection