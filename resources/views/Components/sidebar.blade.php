<div class="main-navbar hor-menu sticky">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html"><i class="ti-home"></i>Dashboard</a>
            </li>
            @role('Sales')
                <li class="nav-item">
                    <a class="nav-link" href="index.html"><i class="ti-"></i>Transaction</a>
                </li>
            @endrole
        </ul>
    </div>
</div>
