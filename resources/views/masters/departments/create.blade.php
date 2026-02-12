@extends('layouts.admin')

@section('content')
    <div class="nxl-content">
        <div class="page-header d-flex align-items-center justify-content-between mb-5">
            <h5 class="mb-0">Add Department</h5>
            <div class="page-header-right">
                <a href="{{ route('departments.index') }}" class="btn btn-light">Back</a>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-10 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('departments.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Department Name <span class="text-danger">*</span></label>
                                <input type="text" name="department_name" value="{{ old('department_name') }}"
                                    class="form-control @error('department_name') is-invalid @enderror">
                                @error('department_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Department Code <span class="text-danger">*</span></label>
                                <input type="text" name="department_code" value="{{ old('department_code') }}"
                                    class="form-control @error('department_code') is-invalid @enderror"
                                    placeholder="MED / NUR / ADM">
                                @error('department_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>



                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-primary">Save</button>
                                <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection