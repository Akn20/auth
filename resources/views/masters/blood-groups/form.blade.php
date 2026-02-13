<div class="mb-4">
    <label class="form-label">
        Blood Group Name <span class="text-danger">*</span>
    </label>

    <input type="text" name="blood_group_name"
            value="{{ old('blood_group_name') }}"
            class="form-control @error('blood_group_name') is-invalid @enderror"
            placeholder="e.g. A+, O-, B+">

    @error('blood_group_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label class="form-label"> Status <span class="text-danger">*</span></label>
    <select name="status" class="form-select">
        <option value="Active" {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}>
            Active
        </option>
        <option value="Inactive" {{ old('status') === 'Inactive' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>

    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>