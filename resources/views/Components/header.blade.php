<div class="main-header side-header">
    <div class="container">
        <div class="main-header-left">
            <a class="main-header-menu-icon d-lg-none" href="" id="mainNavShow"><span></span></a>
            <a class="main-logo" href="{{ route('home') }}">
                <img src="{{ asset('assets/img/brand/erajaya.png') }}" class="header-brand-img desktop-logo w-25" alt="logo">
                <img src="{{ asset('assets/img/brand/erajaya.png') }}" class="header-brand-img desktop-logo theme-logo w-25" alt="logo">
            </a>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/img/brand/erajaya.png') }}" class="mobile-logo w-25" alt="logo"></a>
                <a href="{{ route('home') }}"><img src="{{ asset('assets/img/brand/erajaya.png') }}" class="mobile-logo-dark w-25" alt="logo"></a>
            </div>
        </div>
        <div class="main-header-right">
            <div class="dropdown main-header-notification">
                @php
                    $totaltransaction = App\Models\Transaction::where('status', 0)->count();
                    $transaction = App\Models\Transaction::where('status', 0)
                    ->orderBy('created_at', 'DESC')
                    ->limit(5)
                    ->get();
                @endphp
                @role('Warehouse')
                    <a class="nav-link icon" href="javascript:void(0)">
                        <i class="fe fe-bell header-icons"></i>
                        <span class="badge badge-danger nav-link-badge">{{ $totaltransaction }}</span>
                    </a>
                @endrole
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <p class="main-notification-text">You have {{ $totaltransaction }} unread notification</p>
                    </div>
                    <div class="main-notification-list">
                        @foreach ($transaction as $data)
                            <a href="{{ route('warehouse.transaction.index') }}">
                                <div class="media" id="{{ $data->id }}">
                                    {{-- <div class="main-img-user online"><img alt="avatar" src="{{ asset($data->image) }}"></div> --}}
                                    <div class="media-body">
                                        <p>Transaction with id <strong>{{ $data->id }}</strong> must be validated.</p>
                                        <span>{{ \Carbon\Carbon::parse($data->created_at) }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="dropdown main-profile-menu">
                <a class="d-flex" href="">
                    <span class="main-img-user" ><img alt="avatar" src="{{ Auth::user()->image == null ? asset('assets/img/users/1.jpg') : asset(Auth::user()->image) }}"></span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                        <p class="main-notification-text">{{ Auth::user()->roles->first()->name }}</p>
                    </div>
                    <a class="dropdown-item" href="javascript:void(0);">
                        <i class="fe fe-settings"></i> Account Settings
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="d-none btnlogout">logout</button>
                    </form>
                    <a class="dropdown-item hreflogout" href="javascript:void(0)">
                        <i class="fe fe-power"></i> Sign Out
                    </a>
                </div>
            </div>
            <button class="navbar-toggler navresponsive-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
            </button>
            <!-- Navresponsive closed -->
        </div>
    </div>
</div>
<!-- End Main Header-->

<!-- Mobile-header -->
<div class="mobile-main-header">
    <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div class="dropdown main-header-notification">
                @php
                    $totaltransaction = App\Models\Transaction::where('status', 0)->count();
                    $transaction = App\Models\Transaction::where('status', 0)
                    ->orderBy('created_at', 'DESC')
                    ->limit(5)
                    ->get();
                @endphp
                @role('Warehouse')
                    <a class="nav-link icon" href="javascript:void(0)">
                        <i class="fe fe-bell header-icons"></i>
                        <span class="badge badge-danger nav-link-badge">{{ $totaltransaction }}</span>
                    </a>
                @endrole
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <p class="main-notification-text">You have {{ $totaltransaction }} unread notification</p>
                    </div>
                    <div class="main-notification-list">
                        @foreach ($transaction as $data)
                            <a href="{{ route('warehouse.transaction.index') }}">
                                <div class="media" id="{{ $data->id }}">
                                    {{-- <div class="main-img-user online"><img alt="avatar" src="{{ asset($data->image) }}"></div> --}}
                                    <div class="media-body">
                                        <p>Transaction with id <strong>{{ $data->id }}</strong> must be validated.</p>
                                        <span>{{ \Carbon\Carbon::parse($data->created_at) }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="dropdown main-profile-menu">
                <a class="d-flex" href="">
                    <span class="main-img-user" ><img alt="avatar" src="{{ Auth::user()->image == null ? asset('assets/img/users/1.jpg') : asset(Auth::user()->image) }}"></span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                        <p class="main-notification-text">{{ Auth::user()->roles->first()->name }}</p>
                    </div>
                    <a class="dropdown-item" href="javascript:void(0);">
                        <i class="fe fe-settings"></i> Account Settings
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="d-none btnlogout">logout</button>
                    </form>
                    <a class="dropdown-item hreflogout" href="javascript:void(0)">
                        <i class="fe fe-power"></i> Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
