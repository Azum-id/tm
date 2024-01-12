@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4>Tiket</h4>
                    <small>List Tiket {{ env('APP_NAME') }}</small>
                    <div class="mt-4 table-responsive">
                        <table id="data-table" class="table data-table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Tiket</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Nama Pengunjung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $scan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $scan->ticket_code }}</td>
                                        <td>{{ $scan->status }}</td>
                                        <td>{{ $scan->created_at }}</td>
                                        <td>{{ $scan->transaction->customer_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-center">Total Tiket</th>
                                    <th>{{ $tickets->count() }}</th>
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
