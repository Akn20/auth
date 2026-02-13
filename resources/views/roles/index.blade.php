@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Roles Management</h5>
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
                + Add Role
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Role Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @if($role->status == 1)
                                    <span class="badge bg-soft-success text-success">Active</span>
                                @else
                                    <span class="badge bg-soft-danger text-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                <a href="{{ route('roles.edit', $role->id) }}"
                                              class="action-btn"data-bs-toggle="tooltip"
                                                title="Edit">
                                            <i class="feather-edit"></i>
                                            </a>

                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                     class="action-btn text-danger"
                                    data-bs-toggle="tooltip"
                                    title="Delete User"
                                    style="border:none;background:none;">
                                    <i class="feather feather-trash-2"></i>
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
