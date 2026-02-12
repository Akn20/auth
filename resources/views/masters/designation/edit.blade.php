@extends('layouts.admin')

@section('content')

    <div class="nxl-content">

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Edit Designation</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Masters</li>
                    <li class="breadcrumb-item">Designation</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">

                    <div class="card stretch stretch-full">
                        <div class="card-body">

                            <form action="{{ route('designation.update', $designation->id) }}" method="POST">
                                @csrf
<div class="mb-4">
    <label class="form-label">Designation Code</label>
    <input type="text" name="designation_code" class="form-control"
        value="{{ $designation->designation_code }}">
</div>

                                <div class="mb-4">
                                    <label class="form-label">Designation Name</label>
                                    <input type="text" name="designation_name" class="form-control"
                                        value="{{ $designation->designation_name }}">
                                </div>

                                <!-- Department placeholder -->
                                <select name="department_id" class="form-select">
                                    <option value="">Select Department</option>

                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}" {{ $designation->department_id == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->department_name }}
                                        </option>
                                    @endforeach
                                </select>


                                <div class="mb-4">
                                    <label class="form-label">Description</label>
                                    <textarea name="description"
                                        class="form-control">{{ $designation->description }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Active" {{ $designation->status == 'Active' ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="Inactive" {{ $designation->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>

                                    <a href="{{ route('designation.index') }}" class="btn btn-light">
                                        Cancel
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection