

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @guest

    @else
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">

        {{--<svg src= "{{ asset('./img/svg/logo.svg') }}" alt=" Universite Virtuelle de Tunis" class="brand-image img-circle elevation-3"--}}
             {{--style="opacity: .8"/>--}}

        <img src="{{ asset('./img/logo-uvt.png') }}"  class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">
            {{ config('app.name') }}
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img  src="./img/profile/{{ Auth::user()->photo }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
            </div>
            <div class="info">
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

                <a href="/profile" class="d-block">
                    <p>{{ Auth::user()-> type}}</p>

                    <p>{{ Auth::user()->name }} -{{Auth::user()->prenom}}</p>
                    <p>  {{Auth::user()->profile}}-{{Auth::user()->grade}}</p>
                    <p>  {{Auth::user()->universite_id}}-{{Auth::user()->etablissement_id}}</p>
                </a>

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <router-link to="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt blue"></i>
                        <p>
                            Dashboard

                        </p>
                    </router-link>
                </li>

                @can('isSuperadministratorOrAdministratorOrEnseignant')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-cog green"></i>
                            <p>
                                Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link to="/users" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Users</p>
                                </router-link>
                            </li>

                        </ul>
                    </li>
                @endcan

               @can('isSuperadministratorOrAdministrator')
                <li class="nav-item">
                        <router-link to="/developer" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Developer
                            </p>
                        </router-link>
                    </li>
                @endcan

                <li class="nav-item">
                    <router-link to="/profile" class="nav-link">
                        <i class="nav-icon fas fa-user orange"></i>
                        <p>
                            Profile
                        </p>
                    </router-link>
                </li>

                <li class="nav-item {{ currentRoute(route('logout')) }}">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa fa-power-off red"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

@endguest

</aside>
