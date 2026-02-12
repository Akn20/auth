@extends('layouts.admin')

@section('content')
<div class="nxl-content">

    <div class="page-header d-flex align-items-center justify-content-between mb-5">
        <h5 class="mb-0">Edit Blood Group</h5>
        <div class="page-header-right">
            <a href="{{ route('blood-groups.index') }}" class="btn btn-light"> Back </a>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-12 col-md-10 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('blood-groups.update', $bloodGroup->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Blood Group Name <span class="text-danger">*</span></label>
                            
                            <input type="text" name="blood_group_name"
                                        value="{{ old('blood_group_name') }}"
                                        class="form-control @error('blood_group_name') is-invalid @enderror"
                                        placeholder="e.g. A+, O-, B+">
                            @error('blood_group_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="Active" {{ old('status', $bloodGroup->status) === 'Active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="Inactive" {{ old('status', $bloodGroup->status) === 'Inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('blood-groups.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
