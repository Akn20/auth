<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand">
                <img src="assets/images/logo-full.png" alt="" class="logo logo-lg" />
                <img src="assets/images/logo-abbr.png" alt="" class="logo logo-sm" />
            </a>
        </div>

        <div class="navbar-content">
            <ul class="nxl-navbar">

                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>

                {{-- ================= ORGANIZATION ================= --}}
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-cast"></i></span>
                        <span class="nxl-mtext">Organization</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item">
                            <a class="nxl-link" href="{{ route('organization.index') }}">
                                All Organizations
                            </a>
                        </li>
                        <li class="nxl-item">
                            <a class="nxl-link" href="{{ route('organization.create') }}">
                                Add Organization
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ================= INSTITUTION ================= --}}
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-send"></i></span>
                        <span class="nxl-mtext">Institution</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item">
                            <a class="nxl-link" href="{{ route('institutions.index') }}">
                                All Institutions
                            </a>
                        </li>
                        <li class="nxl-item">
                            <a class="nxl-link" href="{{ route('institutions.create') }}">
                                Add Institution
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ================= MODULE MANAGEMENT ================= --}}
                <li class="nxl-item">
                    <a href="{{ route('modules.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-grid"></i></span>
                        <span class="nxl-mtext">Module Management</span>
                    </a>
                </li>

                <!-- Religion -->
                <li class="nxl-item">
                    <a href="{{ route('religion.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext">Religion</span>
                    </a>
                </li>

                <!-- Job Type -->
                <li class="nxl-item">
                    <a href="{{ route('job-type.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-cast"></i></span>
                        <span class="nxl-mtext">Job Type</span>
                    </a>
                </li>

                <!-- Work Status -->
                <li class="nxl-item">
                    <a href="{{ route('work-status.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-send"></i></span>
                        <span class="nxl-mtext">Work Status</span>
                    </a>
                </li>


                <!-- Designation -->

                <li class="nxl-item">
                    <a href="{{ route('designation.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-send"></i></span>
                        <span class="nxl-mtext">Designation</span>
                    </a>
                </li>
                <!-- Blood Group -->
                <li class="nxl-item">
                    <a href="{{ route('blood-groups.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-droplet"></i></span>
                        <span class="nxl-mtext">Blood Group</span>
                    </a>
                </li>

                <!--Department-->
                <li class="nxl-item">
                    <a href="{{ route('departments.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-grid"></i></span>
                        <span class="nxl-mtext">Department</span>

                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>