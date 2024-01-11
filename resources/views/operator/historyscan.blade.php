@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4>Tiket Hari Ini</h4>
                    <small>Daftar tiket yang dibuat hari ini dan di scan hari ini.</small>
                    <div class="mt-4 table-responsive">
                        <table id="data-table" class="table data-table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Tiket</th>
                                    <th>Tiket Dibuat</th>
                                    <th>Tanggal Scan</th>
                                    <th>Operator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($array_m['scanTickets'] as $scan)
                                    @php
                                        $modifiedTm = substr_replace($scan->ticket->ticket_code, 'xxx', 10, 3);
                                    @endphp

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $modifiedTm }}</td>
                                        <td>{{ $scan->ticket->created_at }}</td>
                                        <td>{{ $scan->created_at }}</td>
                                        <td>{{ $scan->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-center">Total Scan</th>
                                    <th>{{ $array_m['scanTickets']->count() }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4>Tiket Hari Lain</h4>
                    <small>Apabila ada tiket di hari lain yang belum di scan, lalu di scan di hari ini, maka tiket tersebut akan muncul di sini.</small>
                    <div class="mt-4 table-responsive">
                        <table id="data-table" class="table data-table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Tiket</th>
                                    <th>Tiket Dibuat</th>
                                    <th>Tanggal Scan</th>
                                    <th>Operator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($array_m['oldScanTickets'] as $scan)
                                    @php
                                        $modifiedTm = substr_replace($scan->ticket->ticket_code, 'xxx', 10, 3);
                                    @endphp

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $modifiedTm }}</td>
                                        <td>{{ $scan->ticket->created_at }}</td>
                                        <td>{{ $scan->created_at }}</td>
                                        <td>{{ $scan->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-center">Total Scan</th>
                                    <th>{{ $array_m['oldScanTickets']->count() }}</th>
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
