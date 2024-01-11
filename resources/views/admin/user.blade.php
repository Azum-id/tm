@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="mb-0">Daftar User</h4>
                        <button class="btn btn-info btn-sm">Add User</button>
                    </div>
                    <div class="mt-4 table-responsive">
                        <table id="data-table" class="table data-table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">
                                                <i class="icon-eye feather"></i>
                                                View
                                            </a>
                                            <a href="#" class="btn btn-warning btn-sm">
                                                <i class="icon-edit feather"></i>
                                                Edit
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm">
                                                <i class="icon-trash-2 feather"></i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Actions</th>
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
        // make first column small just for id,
        // jangan biarkan search di column ke 4
        $('table.data-table').DataTable({
            columnDefs: [{
                    width: 10,
                    targets: 0
                },
                {
                    searchable: false,
                    targets: 3
                }
            ],
            fixedColumns: true,
        });
    </script>
@endsection
