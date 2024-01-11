@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4>Scan Tiket Masuk</h4>
                    <p>Validasi Tiket masuk {{ env('APP_NAME') }} Sebelum masuk gate</p>
                    <div class="mt-3">
                        <form action="/scan" method="POST" id="form_scan">
                            @csrf
                            <div class="mb-3">
                                <label for="kode_tiket" class="form-label">Kode Tiket</label>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <input type="text" class="form-control form-control-sm" name="kode_tiket" id="kode_tiket" placeholder="Kode Tiket"
                                        autofocus>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Submit</button>
                            <button id="scan_qr" class="btn btn-primary btn-sm" type="button"><i class="fa fa-qrcode"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div id="result">
                        <h4>Result</h4>
                        {{-- Result content will be replaced via AJAX --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('azs_js')
    <script>
        $('#form_scan').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var kode_tiket = $('#kode_tiket').val();
            var token = $('input[name=_token]').val();

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    kode_tiket: kode_tiket,
                    _token: token
                },
                success: function(data) {
                    // if data.status is success
                    if (data.status == 'success') {
                        // Use Moment.js to format the date
                        var formattedDate = moment(data.data.created_at).format('YYYY-MM-DD HH:mm:ss');

                        // Format Total Price to Indonesian Rupiah
                        var formattedPrice = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(data.data.transaction.total_price);

                        // Customize the result HTML here based on the API response
                        var resultHtml = '<div class="alert alert-success" role="alert">';
                        resultHtml += '<h4 class="alert-heading">Scan Result</h4>';
                        resultHtml += '<hr>';
                        resultHtml += '<p>Scan Date: <b>' + formattedDate + '</b></p>';
                        resultHtml += '<p>Transaction Code: <b>' + data.data.ticket_code + '</b></p>';
                        resultHtml += '<p>Total Price: <b> ' + formattedPrice + '</b></p>';
                        resultHtml += '<hr>';
                        // add success message
                        resultHtml += '<p class="mt-2">' + data.message + '</p>';
                        resultHtml += '</div>';
                        $('#result').html(resultHtml);
                    } else {
                        // Customize the result HTML here based on the API response
                        var resultHtml = '<div class="alert alert-danger" role="alert">';
                        resultHtml += '<h4 class="alert-heading">Scan Result</h4>';
                        resultHtml += '<hr>';
                        resultHtml += '<p class="mt-2">' + data.message + '</p>';
                        resultHtml += '</div>';
                        $('#result').html(resultHtml);
                    }
                },
                error: function(error) {
                    // Customize the result HTML here based on the API response
                    var resultHtml = '<div class="alert alert-danger" role="alert">';
                    resultHtml += '<h4 class="alert-heading">Scan Result</h4>';
                    resultHtml += '<hr>';
                    resultHtml += '<p class="mt-2">' + error.responseJSON.message + '</p>';
                    resultHtml += '</div>';
                    $('#result').html(resultHtml);
                }
            });
        });
    </script>
@endsection
