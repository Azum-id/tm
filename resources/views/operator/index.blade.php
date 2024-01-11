@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4>Tiket Masuk</h4>
                    <p>Pembelian Tiket Masuk {{ env('APP_NAME') }}</p>
                    <div class="mt-3">
                        <form action="/kasir" method="POST" id="form_kasir">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_pengunjung" class="form-label">Nama Pengunjung (Opsional)</label>
                                <input type="text" class="form-control" name="nama_pengunjung" id="nama_pengunjung" placeholder="Nama Pengunjung"
                                    autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                                <input type="number" class="form-control" name="jumlah_tiket" id="jumlah_tiket" placeholder="Jumlah Tiket" required>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4>Result</h4>
                    <div id="result" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('azs_js')
    <script>
        function checkCsrfToken() {
            // Ambil CSRF token saat ini melalui AJAX
            $.get('/validate-token', function(data) {
                var currentToken = $('meta[name="csrf-token"]').attr('content');

                // Periksa apakah token telah berubah
                if (data.token !== currentToken) {
                    // Refresh halaman jika token berubah
                    location.reload();
                }
            });
        }

        // Set interval untuk memanggil fungsi setiap detik
        setInterval(checkCsrfToken, 2000);
    </script>
    <script>
        // function for convert number to rupiah
        function convertToRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
        }
        $('#form_kasir').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var nama_pengunjung = $('#nama_pengunjung').val();
            var jumlah_tiket = $('#jumlah_tiket').val();
            var token = $('input[name=_token]').val();

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    nama_pengunjung: nama_pengunjung,
                    jumlah_tiket: jumlah_tiket,
                    _token: token
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 'success') {
                        $('#nama_pengunjung').val('');
                        $('#jumlah_tiket').val('');
                        $('#nama_pengunjung').focus();

                        // Menampilkan data dari respons API ke dalam elemen dengan ID "result"
                        var resultHtml = `
                        <div class="alert alert-success" role="alert">
                            ${data.message}
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Kode Transaksi : <strong>${data.data.trx_code}</strong></li>
                            <li class="list-group-item">Nama Kustomer : <strong>${data.data.customer_name}</strong></li>
                            <li class="list-group-item">Total Tiket : <strong>${data.data.total_ticket}</strong></li>
                            <li class="list-group-item">Total Harga : <strong>${convertToRupiah(data.data.total_price)}</strong></li>
                        </ul>`;
                        $('#result').html(resultHtml);

                    } else {
                        // Menampilkan pesan error jika transaksi gagal
                        var errorHtml = '<div class="alert alert-danger" role="alert">';
                        errorHtml += '<h4 class="alert-heading">Transaksi Gagal!</h4>';
                        errorHtml += '<p>' + data.message + '</p>';
                        errorHtml += '</div>';
                        $('#result').html(errorHtml);
                    }
                }
            });
        });
    </script>
@endsection
