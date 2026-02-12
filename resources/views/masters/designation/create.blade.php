@extends('layouts.admin')

@section('content')

    <div class="nxl-content">

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Add Designation</h5>
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

                            <form action="{{ route('designation.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">
                                        Designation Code <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="designation_code" class="form-control"
                                        placeholder="Enter designation code (DOC, NUR, LAB)">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">
                                        Designation Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="designation_name" class="form-control"
                                        placeholder="Enter designation name">
                                </div>

                                <!-- Department dropdown (optional for now) -->
                                <div class="mb-4">
                                    <label class="form-label">Department</label>
                                    <select name="department_id" class="form-select">
                                        <option value="">Select Department</option>

                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}">
                                                {{ $dept->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-4">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control"
                                        placeholder="Enter description"></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        Save
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