@extends('layouts.admin')

@section('content')

    <div class="nxl-content">

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Designation Master</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Masters</li>
                    <li class="breadcrumb-item">Designation</li>
                </ul>
            </div>

            <div class="page-header-right ms-auto d-flex gap-2">
                <a href="{{ route('designation.trash') }}" class="btn btn-neutral">
                    Deleted Records
                </a>

                <a href="{{ route('designation.create') }}" class="btn btn-neutral">
                    Add Designation
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Code</th>
                                            <th>Designation Name</th>
                                            <th>Department</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($designations as $index => $designation)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>

                                                <td>
                                                    <span class="badge bg-soft-primary text-primary">
                                                        {{ $designation->designation_code }}
                                                    </span>
                                                </td>

                                                <td>{{ $designation->designation_name }}</td>

                                                <td>
                                                    {{ $designation->department->department_name ?? '-' }}
                                                </td>

                                                <td>{{ $designation->description ?? '-' }}</td>

                                                <td>
                                                    @if($designation->status)
                                                        <span class="badge bg-soft-success text-success">Active</span>
                                                    @else
                                                        <span class="badge bg-soft-danger text-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                <td class="text-end">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a href="{{ route('designation.edit', $designation->id) }}"
                                                            class="avatar-text avatar-md action-icon action-edit">
                                                            <i class="feather-edit"></i>
                                                        </a>

                                                        <a href="{{ route('designation.delete', $designation->id) }}"
                                                            class="avatar-text avatar-md action-icon action-delete">
                                                            <i class="feather-trash-2"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection