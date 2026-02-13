@extends('layouts.admin')

@section('content')

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf


    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Role</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Role Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Save Role
        </button>
    </form>


        </div>
    </div>

@endsection


