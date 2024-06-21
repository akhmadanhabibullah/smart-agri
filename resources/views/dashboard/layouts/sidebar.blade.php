<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" role="button" class="nav-link collapsed dropdown-toggle" data-bs-toggle="collapse"
                    data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <span data-feather="settings"></span> Tanah Pintar 1
                </a>
                <ul id="auth" class="collapse list-unstyled">
                    <li>
                        <a class="dropdown-item nav-link {{ Request::is('dashboard/dashboard-1') ? 'active' : '' }}"
                            aria-current="page" href="/dashboard/dashboard-1">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                    {{-- @can('admin') --}}
                        <li class="nav-item">
                            <a class="dropdown-item nav-link {{ Request::is('dashboard/measurement') ? 'active' : '' }}"
                                href="/dashboard/measurement">
                                <span data-feather="file-text"></span>
                                Pengukuran
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item nav-link {{ Request::is('dashboard/location') ? 'active' : '' }}"
                                href="/dashboard/location">
                                <span data-feather="map-pin"></span>
                                Lokasi
                            </a>
                        </li>
                    {{-- @endcan --}}
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" role="button" class="nav-link collapsed dropdown-toggle" data-bs-toggle="collapse"
                    data-bs-target="#auth2" aria-expanded="false" aria-controls="auth2">
                    <span data-feather="settings"></span> Tanah Pintar 2
                </a>
                <ul id="auth2" class="collapse list-unstyled">
                    <li>
                        <a class="dropdown-item nav-link {{ Request::is('dashboard/dashboard-2') ? 'active' : '' }}"
                            aria-current="page" href="/dashboard/dashboard-2">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                    {{-- @can('admin') --}}
                        <li class="nav-item">
                            <a class="dropdown-item nav-link {{ Request::is('dashboard/measurement-2*') ? 'active' : '' }}"
                                href="/dashboard/measurement-2">
                                <span data-feather="file-text"></span>
                                Pengukuran
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item nav-link {{ Request::is('dashboard/location-2*') ? 'active' : '' }}"
                                href="/dashboard/location-2">
                                <span data-feather="map-pin"></span>
                                Lokasi
                            </a>
                        </li>
                    {{-- @endcan --}}
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" role="button" class="nav-link collapsed dropdown-toggle" data-bs-toggle="collapse"
                    data-bs-target="#auth3" aria-expanded="false" aria-controls="auth3">
                    <span data-feather="settings"></span> Air Pintar
                </a>
                <ul id="auth3" class="collapse list-unstyled">
                    <li>
                        <a class="dropdown-item nav-link {{ Request::is('dashboard/dashboard-3') ? 'active' : '' }}"
                            aria-current="page" href="/dashboard/dashboard-3">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                    {{-- @can('admin') --}}
                        <li class="nav-item">
                            <a class="dropdown-item nav-link {{ Request::is('dashboard/measurement-3*') ? 'active' : '' }}"
                                href="/dashboard/measurement-3">
                                <span data-feather="file-text"></span>
                                Pengukuran
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item nav-link {{ Request::is('dashboard/location-3*') ? 'active' : '' }}"
                                href="/dashboard/location-3">
                                <span data-feather="map-pin"></span>
                                Lokasi
                            </a>
                        </li>
                    {{-- @endcan --}}
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/map*') ? 'active' : '' }}" href="/dashboard/map">
                    <span data-feather="map"></span>
                    Peta
                </a>
            </li>
            {{-- @can('admin') --}}
                {{-- <li class="nav-item dropdown">
                    <a href="#" role="button" class="nav-link collapsed dropdown-toggle" data-bs-toggle="collapse"
                        data-bs-target="#auth4" aria-expanded="false" aria-controls="auth">
                        <span data-feather="settings"></span> Tampilan
                    </a>
                    <ul id="auth4" class="collapse list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link dropdown-item {{ Request::is('dashboard/highlight*') ? 'active' : '' }}"
                                href="/dashboard/highlight">
                                <span data-feather="layout"></span>
                                Sorotan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-item {{ Request::is('dashboard/feature*') ? 'active' : '' }}" href="/dashboard/feature">
                                <span data-feather="layers"></span>
                                Fitur
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-item  {{ Request::is('dashboard/testimonial*') ? 'active' : '' }}"
                                href="/dashboard/testimonial">
                                <span data-feather="star"></span>
                                Testimoni
                            </a>
                        </li> 
                    </ul> --}}
                    <li class="nav-item">
                        <a class="nav-link  {{ Request::is('dashboard/table-guideline*') ? 'active' : '' }}"
                            href="/dashboard/table-guideline">
                            <span data-feather="trello"></span>
                            Tabel Pedoman
                        </a>
                    </li> 
                </li>
                
            </ul>
        {{-- @endcan --}}

    </div>
</nav>
