@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Pembelian / Restok</h2>
    @if (session()->has('success'))
    <div class="row justify-content-center">
        <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
            <form class="search-form input-group rounded" action="/barang-masuk">
                <input name="search" type="search" class="form-control" placeholder="Search Here" title="Search here">
                <button style="height: 2rem" class="btn btn-outline-secondary justify-content-center py-0" type="submit"
                    id="button-addon2" class="p-0">
                    <i class="icon-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabel Hasil Pencarian</h4>
                @if ($search && $barangs->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Kode
                                </th>
                                <th>
                                    Nama Barang
                                </th>
                                <th class="d-none d-sm-table-cell">
                                    Stok Barang
                                </th>
                                <th class="d-none d-sm-table-cell">
                                    Stok Minimum
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                            <tr>
                                <td>
                                    {{ $barang->kode_barang }}
                                </td>
                                <td>
                                    {{ $barang->name }}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{ $barang->jumlah_stok }}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{ $barang->stok_minimum }}
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" data-barang-id="{{ $barang->id }}"
                                        onclick="addToSelectedList({{ $barang->id }})">Tambahkan ke list</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $barangs->links() }}
                </div>
                @elseif (!$search)
                <p>Silakan lakukan pencarian.</p>
                @else
                <p>Tidak ada hasil pencarian.</p>
                @endif
            </div>
        </div>
    </div>

    <hr class="pt-1">

    <div class="col-md-2 mb-2">
        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
            <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon"></span>
            </span>
            <input type="text" class="form-control">
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Daftar Barang</h4>
                <code>*List barang yang direstok</code>
                @if (!empty($selectedItems))
                <form id="updateForm" action="/update-barang-pembelian" method="POST">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th class="d-none d-sm-table-cell">Stok Barang</th>
                                    <th class="d-none d-sm-table-cell">Stok Minimum</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selectedItems as $barangId)
                                @php
                                $barang = \App\Models\Barang::findOrFail($barangId);
                                @endphp
                                <tr id="barang-row-{{ $barang->id }}">
                                    <td>{{ $barang->kode_barang }}</td>
                                    <td>{{ $barang->name }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $barang->jumlah_stok }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $barang->stok_minimum }}</td>
                                    <td>
                                        <input size="10" type="number" name="updateStok[{{ $barang->id }}]"
                                            id="updateStok-{{ $barang->id }}" data-barang-id="{{ $barang->id }}"
                                            value="{{ old('updateStok.' . $barang->id) }}" min="1" required>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-secondary btn-rounded btn-icon"
                                            data-barang-id="{{ $barang->id }}"
                                            onclick="deleteBarang({{ $barang->id }})">
                                            <i class="mdi mdi-trash-can text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @csrf
                    <div class="d-flex justify-content-end mt-3">
                        <a class="btn btn-light" href="/barang-masuk">Cancel</a>
                        <button type="submit" onclick="return confirm('Anda Yakin?')" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Memperbarui nilai input jumlah stok ke penyimpanan lokal saat perubahan nilai input terjadi
    $('input[name^="updateStok"]').on('input', function() {
        var barangId = $(this).data('barang-id');
        var jumlahStokValue = $(this).val();
        localStorage.setItem('updateStokValue_' + barangId, jumlahStokValue);
    });

    // Memuat kembali nilai input jumlah stok dari penyimpanan lokal saat halaman dimuat
    $(document).ready(function() {
        $('input[name^="updateStok"]').each(function() {
            var barangId = $(this).data('barang-id');
            var storedJumlahStokValue = localStorage.getItem('updateStokValue_' + barangId);
            if (storedJumlahStokValue) {
                $(this).val(storedJumlahStokValue);
            }
        });
    });
</script>
<script>
    function submitUpdateForm() {
    const form = document.getElementById('updateForm');
    const updateStokInputs = form.querySelectorAll('input[name="updateStok[]"]');
    const data = [];

    updateStokInputs.forEach(function(input) {
        const barangId = input.dataset.barangId;
        const jumlahStok = input.value;

        data.push(barangId); // Only store the barangId in the array
    });

    fetch('/update-barang-pembelian', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ updateStok: data }) // Send the data as an object with the key 'updateStok'
    })
    .then(response => response.json())
    .then(data => {
    if (data.success) {
        // Tampilkan pesan sukses
        }
    })
    .catch(error => {
        console.log(error);
    });
}
</script>

<script>
    function addToSelectedList(barangId) {
    $.ajax({
        url: '/tambah-barang-pembelian',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            barangId: barangId
        },
        success: function(response) {
            if (response.success) {
                // Perbarui halaman
                location.reload();
            } else {
                // Tampilkan pesan error
                console.log(response.message);
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

function deleteBarang(barangId) {
    // Lakukan request AJAX ke endpoint penghapusan barang
    // Gantikan URL '/delete-barang-pembelian' sesuai dengan URL endpoint Anda
    fetch('/delete-barang-pembelian', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ barangId: barangId })
    })
    .then(response => response.json())
    .then(data => {
        // Hapus baris tabel dari tampilan
        if (data.success) {
            const row = document.getElementById('barang-row-' + barangId);
            if (row) {
                row.remove();
            }
            // Perbarui jumlah barang yang dipilih
            const selectedCount = document.getElementById('selected-count');
            if (selectedCount) {
                selectedCount.textContent = parseInt(selectedCount.textContent) - 1;
            }
        }
    })
    .catch(error => {
        console.log(error);
    });
}

</script>
@endsection