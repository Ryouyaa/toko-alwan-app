@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Transaksi Penjualan</h2>
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
            <form class="search-form input-group rounded" action="/barang-keluar">
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
                                    ID
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
                                    {{ $barang->id }}
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
                <h4 class="card-title mb-0">Daftar Barang Transaksi</h4>
                <code>*List barang yang dijual</code>
                @if (!empty($selectedItemsPenjualan))
                <form id="updateForm" action="/update-barang-penjualan" method="POST">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="d-none d-sm-table-cell">ID</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>SubTotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selectedItemsPenjualan as $barangId)
                                @php
                                $barang = \App\Models\Barang::findOrFail($barangId);
                                @endphp
                                <tr id="barang-row-{{ $barang->id }}">
                                    <td>{{ $barangs->firstItem() + $loop->index }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $barang->id }}</td>
                                    <td>{{ $barang->name }}</td>
                                    <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                    <td>
                                        <input size="10" type="number" name="updateStok[{{ $barang->id }}]"
                                            id="updateStok-{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}"
                                            data-barang-id="{{ $barang->id }}"
                                            value="{{ old('updateStok.' . $barang->id) }}" min="1" max="{{ $barang->jumlah_stok }}" required>
                                    </td>
                                    <td id="subtotal-{{ $barang->id }}" class="subtotal">Rp 0</td>
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
                    <div class="d-flex justify-content-end">
                        <div class="col-lg-2 col-4 my-auto">
                            <label for="diskon">Diskon (Rp)</label>
                        </div>
                        <div class="col-lg-2 col-4 p-2">
                            <input type="text" class="form-control input-sm" id="diskon" name="diskon">
                        </div>
                    </div>                    
                    <div class="d-flex justify-content-end">
                        <div class="col-lg-2 col-4 my-auto">
                            <label>Total</label>
                        </div>
                        <div class="col-lg-2 col-4 px-2">
                            <p5 id="total">Rp 0</p5>
                        </div>
                    </div>
                    @csrf
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-light">Cancel</a>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"> </script>
<script>
    // Memperbarui nilai input jumlah stok ke penyimpanan lokal saat perubahan nilai input terjadi
   $('input[name^="updateStok"]').on('input', function () {
      var barangId = $(this).data('barang-id');
      var jumlahStokValue = $(this).val();
      localStorage.setItem('updateStokValue_' + barangId, jumlahStokValue);
   });

    // Memuat kembali nilai input jumlah stok dari penyimpanan lokal saat halaman dimuat
    $(document).ready(function () {
    $('input[name^="updateStok"]').each(function () {
        var barangId = $(this).data('barang-id');
        var storedJumlahStokValue = localStorage.getItem('updateStokValue_' + barangId);
        if (storedJumlahStokValue) {
            $(this).val(storedJumlahStokValue);
        }
    });
    });

    document.addEventListener('DOMContentLoaded', function () {
    // Ambil semua elemen input jumlah
    var inputJumlah = document.querySelectorAll('input[name^="updateStok"]');

    // Tambahkan event listener untuk input diskon
    var diskonInput = document.getElementById('diskon');
    diskonInput.addEventListener('blur', function () {
        var diskonValue = parseInt(diskonInput.value.replace(/[^0-9]/g, '')); // Hapus karakter non-digit dari input diskon
        var totalElem = document.getElementById('total');
        var total = parseInt(totalElem.textContent.replace(/[^0-9]/g, '')); // Hapus karakter non-digit dari total

        var finalTotal = total - diskonValue; // Hitung total setelah diskon

        // Perbarui elemen total dengan nilai yang baru dihitung
        totalElem.textContent = 'Rp ' + finalTotal.toLocaleString(); // Tampilkan total setelah diskon dengan format yang diinginkan
    });

    // Tambahkan event listener untuk setiap input jumlah
    inputJumlah.forEach(function (input) {
        input.addEventListener('input', function () {
            var jumlah = parseInt(input.value); // Ambil nilai input jumlah
            var harga = parseInt(input.getAttribute('data-harga')); // Ambil nilai harga dari atribut data-harga
            var subtotal = jumlah * harga; // Hitung subtotal

            // Perbarui elemen subtotal dengan nilai yang baru dihitung
            var subtotalElem = input.parentNode.nextElementSibling; // Dapatkan elemen subtotal terkait
            subtotalElem.textContent = 'Rp ' + subtotal.toLocaleString(); // Tampilkan subtotal dengan format yang diinginkan

            // Hitung total berdasarkan subtotal yang diperbarui
            var subtotals = document.querySelectorAll('.subtotal'); // Ambil semua elemen subtotal
            var total = 0;
            subtotals.forEach(function (subtotalElem) {
                var subtotalValue = parseInt(subtotalElem.textContent.replace(/[^0-9]/g, '')); // Hapus karakter non-digit dari subtotal
                total += subtotalValue; // Tambahkan subtotal ke total
            });

            // Perbarui elemen total dengan nilai yang baru dihitung
            var totalElem = document.getElementById('total');
            totalElem.textContent = 'Rp ' + total.toLocaleString(); // Tampilkan total dengan format yang diinginkan
        });
    });

    // Trigger event input untuk menghitung subtotal saat halaman dimuat ulang
    var event = new Event('input');
    inputJumlah.forEach(function (input) {
        input.dispatchEvent(event);
    });
    });
</script>

<script>
    function submitUpdateForm() {
    const form = document.getElementById('updateForm');
    const updateStokInputs = form.querySelectorAll('input[name^="updateStok["]');
    const data = [];

    updateStokInputs.forEach(function (input) {
        const barangId = input.dataset.barangId;
        const jumlahStok = input.value;

        data.push({
            barangId: barangId,
            jumlahStok: jumlahStok
        });
    });

        fetch('/update-barang-penjualan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            // Menangani respon dari server setelah penyimpanan berhasil
            console.log(data);
            // Lakukan tindakan lain yang sesuai, seperti menampilkan pesan sukses atau memperbarui tampilan
        })
        .catch(error => {
            // Menangani error jika terjadi kesalahan
            console.error('Error:', error);
            // Lakukan tindakan lain yang sesuai, seperti menampilkan pesan error atau memberikan feedback ke pengguna
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
    // Ambil semua elemen input jumlah
    var inputJumlah = document.querySelectorAll('input[name^="updateStok"]');

    // Tambahkan event listener untuk setiap input jumlah
    inputJumlah.forEach(function (input) {
        input.addEventListener('input', function () {
            var jumlah = parseInt(input.value); // Ambil nilai input jumlah
            var harga = parseInt(input.getAttribute('data-harga')); // Ambil nilai harga dari atribut data-harga
            var subtotal = jumlah * harga; // Hitung subtotal

            // Perbarui elemen subtotal dengan nilai yang baru dihitung
            var subtotalElem = input.parentNode.nextElementSibling; // Dapatkan elemen subtotal terkait
            subtotalElem.textContent = 'Rp ' + subtotal.toLocaleString(); // Tampilkan subtotal dengan format yang diinginkan
        });
    });

    // Trigger event input untuk menghitung subtotal saat halaman dimuat ulang
    var event = new Event('input');
    inputJumlah.forEach(function (input) {
        input.dispatchEvent(event);
    });
    });
</script>

<script>
    function addToSelectedList(barangId) {
      $.ajax({
         url: '/tambah-barang-penjualan',
         type: 'POST',
         data: {
            _token: '{{ csrf_token() }}',
            barangId: barangId
         },
         success: function (response) {
            if (response.success) {
               // Perbarui halaman
               location.reload();
            } else {
               // Tampilkan pesan error
               console.log(response.message);
            }
         },
         error: function (xhr) {
            console.log(xhr.responseText);
         }
      });
   }

    function deleteBarang(barangId) {
    // Lakukan request AJAX ke endpoint penghapusan barang
    // Gantikan URL '/delete-barang-penjualan' sesuai dengan URL endpoint Anda
    fetch('/delete-barang-penjualan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                barangId: barangId
            })
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