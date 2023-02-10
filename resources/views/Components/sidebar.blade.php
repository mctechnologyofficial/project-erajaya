<div class="main-navbar hor-menu sticky">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i>Dashboard</a>
            </li>
            @role('Sales')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sales.transaction.index') }}"><i class="fas fa-dollar-sign"></i>Transaction</a>
                </li>
            @endrole
        </ul>
    </div>
</div>
