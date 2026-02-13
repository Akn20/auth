@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Edit Role</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Role Name</label>
                    <input type="text" name="name"
                           value="{{ $role->name }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $role->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $role->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

@endsection
