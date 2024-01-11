@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4>Penjualan</h4>
                    <small>History Penjualan {{ env('APP_NAME') }}</small>
                    <div class="mt-4 table-responsive">
                        <table id="data-table" class="table data-table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode TRX</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pengunjung</th>
                                    <th>Total Harga</th>
                                    <th>Operator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $scan)
                                    @php
                                        $modifiedTm = substr_replace($scan->trx_code, 'xxx', 10, 3);
                                    @endphp

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $modifiedTm }}</td>
                                        <td>{{ $scan->created_at }}</td>
                                        <td>{{ $scan->customer_name }}</td>
                                        {{-- <td>{{ $scan->total_price }}</td>formated price --}}
                                        <td>Rp. {{ number_format($scan->total_price, 0, ',', '.') }}</td>
                                        <td>{{ $scan->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-center">Total Transaksi</th>
                                    <th>{{ $transactions->count() }}</th>
                                    <th colspan="2" class="text-center">Total Pendapatan</th>
                                    <th>Rp. {{ number_format($transactions->sum('total_price'), 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('azs_js')
    <script>
        $('.data-table').DataTable();
    </script>
@endsection
