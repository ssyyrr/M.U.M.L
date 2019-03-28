    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        @guest
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">

                   <img src="./img/logo-uvt.png" alt="Université Virtuelle de Tunis" class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    {{ config('app.name') }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ currentRoute(route('login')) }}">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>

                        <li class="nav-item {{ currentRoute(route('register')) }}">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('register') }}</a></li>
                    </ul>


                </div>
            </div>

        @else
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>

    </ul>

    <!-- SEARCH FORM -->
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search"
               placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" @click="searchit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>


@endguest

</nav>
