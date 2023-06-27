<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark position-fixed vh-100">
    <div class="d-flex flex-column pt-4 text-white vh-100">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4 d-none d-sm-inline text-uppercase">Menu</span>
        </a>
        <ul class="nav nav-pills flex-column mb-auto text-uppercase">
            <li>
                <a href="{{ route('d-home')}}" class="nav-link px-0 align-middle border-bottom border-white rounded-0 text-white
                    @if (request()->routeIs('d-home'))
                        actives
                    @endif
                ">
                <i class="fa-solid fa-house ps-2"></i> <span class="ms-2 d-none d-sm-inline fw-bold">Home</span></a>
            </li>
            <li>
                <a href="{{ route('d-profiling')}}" class="nav-link px-0 align-middle border-bottom border-white rounded-0 text-white
                    @if (request()->routeIs('d-profiling'))
                    actives
                    @endif
                ">
                    <i class="fa-solid fa-users ps-2"></i> <span class="ms-2 d-none d-sm-inline fw-bold">Profiles</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link px-0 align-middle border-bottom border-white rounded-0 text-white" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fs-4 bi-table"></i> <span class="ms-2 d-none d-sm-inline fw-bold">Orders</span></a>
                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenu2">
                  <li><button class="dropdown-item" type="button">Action</button></li>
                  <li><button class="dropdown-item" type="button">Another action</button></li>
                  <li><button class="dropdown-item" type="button">Something else here</button></li>
                </ul>
            </li>
        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-circle-user fs-3" width='30' height='30'></i>
                <span class="d-none d-sm-inline mx-2 fw-bold">Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-white text-small text-dark shadow w-100">
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>
