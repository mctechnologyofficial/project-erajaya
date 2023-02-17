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
            @role('Warehouse')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('warehouse.transaction.index') }}"><i class="fas fa-dollar-sign"></i>Transaction</a>
                </li>
            @endrole
            @role('Admin')
                <li class="nav-item {{ Route::is('admin.user.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.user.index') }}"><i class="fas fa-users"></i>User</a>
                </li>
                <li class="nav-item {{ Route::is('admin.product.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.product.index') }}"><i class="fas fa-boxes"></i>Product</a>
                </li>
            @endrole
        </ul>
    </div>
</div>
