<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div>
          @include('layouts.partials.logo')
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div>
            <a href="#" class="btn btn-hero btn-hero-hero-blue btn-hero-lg header-scroll">Nominate a Superstar!</a>

            @if(Auth::user())
                <a href="{{ route('awards.index') }}" class="btn btn-hero btn-hero-primary btn-hero-lg header-scroll">Settings</a>

                <a href="{{ route('logout') }}" class="btn btn-hero btn-hero-primary btn-hero-lg waves-effect waves-light"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i>
                     Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            @endif
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary-darker">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->
