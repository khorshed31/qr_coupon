@if (hasAnyPermission(['product.products.create', 'product.products.index', 'product.units.index'], $slugs))
<li>
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-shopping-bag"></i>
        <span class="menu-text">Product</span>
        <b class="arrow fa fa-angle-down"></b>
    </a>
    <b class="arrow"></b>
    <ul class="submenu">

        @if (hasPermission('product.products.create', $slugs))
            <li id="">
                <a href="{{ route('product.products.create') }}">
                    <i class="menu-icon fa fa-caret-right"></i>Add Product</a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (hasPermission('product.products.index', $slugs))
                <li id="">
                    <a href="{{ route('product.products.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>Product list</a>
                    <b class="arrow"></b>
                </li>
        @endif

            @if (hasPermission('product.units.index', $slugs))
                <li id="">
                    <a href="{{ route('product.units.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Unit List
                    </a>
                    <b class="arrow"></b>
                </li>
            @endif

    </ul>
</li>
@endif

@if (hasAnyPermission(['product.qr-generates.create', 'product.qr-generates.index'], $slugs))
    <li>
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-qrcode"></i>
        <span class="menu-text">Qr Code</span>
        <b class="arrow fa fa-angle-down"></b>
    </a>
    <b class="arrow"></b>
    <ul class="submenu">

        @if (hasPermission('product.qr-generates.create', $slugs))
            <li id="">
                <a href="{{ route('product.qr-generates.create') }}">
                    <i class="menu-icon fa fa-caret-right"></i>Generate</a>
                <b class="arrow"></b>
            </li>
        @endif

            @if (hasPermission('product.qr-generates.index', $slugs))
                <li id="">
                    <a href="{{ route('product.qr-generates.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>QR Code List</a>
                    <b class="arrow"></b>
                </li>
            @endif

    </ul>
</li>
@endif

@if (hasAnyPermission(['product.users.store', 'product.users.index'], $slugs))
    <li>
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-user"></i>
        <span class="menu-text">User Management</span>
        <b class="arrow fa fa-angle-down"></b>
    </a>
    <b class="arrow"></b>
    <ul class="submenu">

        @if (hasPermission('product.users.store', $slugs))
            <li id="">
                <a href="{{ route('product.users.create') }}">
                    <i class="menu-icon fa fa-caret-right"></i>Add User</a>
                <b class="arrow"></b>
            </li>
        @endif

            @if (hasPermission('product.users.index', $slugs))
                <li id="">
                    <a href="{{ route('product.users.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>User List</a>
                    <b class="arrow"></b>
                </li>
            @endif


    </ul>
</li>
@endif

@if (hasAnyPermission(['product.customers.store', 'product.customers.index'], $slugs))
    <li>
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-user"></i>
        <span class="menu-text">Customer</span>
        <b class="arrow fa fa-angle-down"></b>
    </a>
    <b class="arrow"></b>
    <ul class="submenu">

        @if (hasPermission('product.customers.store', $slugs))
        <li id="">
            <a href="{{ route('product.customers.create') }}">
                <i class="menu-icon fa fa-caret-right"></i>Add Customer</a>
            <b class="arrow"></b>
        </li>
        @endif

        @if (hasPermission('product.customers.index', $slugs))
            <li id="">
                <a href="{{ route('product.customers.index') }}">
                    <i class="menu-icon fa fa-caret-right"></i>Customer List</a>
                <b class="arrow"></b>
            </li>
        @endif

            @if (hasPermission('product.customers.store', $slugs))
                <li id="">
                    <a href="{{ route('product.customers.create', ['upload' => 'product']) }}">
                        <i class="menu-icon fa fa-upload"></i>Customer Upload</a>
                    <b class="arrow"></b>
                </li>
            @endif


    </ul>
</li>
@endif



@if (hasAnyPermission(['product.referral_employees.create', 'product.referral_employees.index'], $slugs))
    <li>
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-user"></i>
            <span class="menu-text">Referral Employee</span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">

            @if (hasPermission('product.referral_employees.store', $slugs))
                <li id="">
                    <a href="{{ route('product.referral_employees.create') }}">
                        <i class="menu-icon fa fa-caret-right"></i>Add Referral Employee</a>
                    <b class="arrow"></b>
                </li>
            @endif

            @if (hasPermission('product.referral_employees.index', $slugs))
                <li id="">
                    <a href="{{ route('product.referral_employees.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>Referral Employee List</a>
                    <b class="arrow"></b>
                </li>
            @endif

        </ul>
    </li>
@endif

@if (hasPermission('product.withdraw_requests.index', $slugs))
    <li id="business_setting">
        <a href="{{ route('product.withdraw_requests.index') }}">
            <i class="fa fa-check menu-icon" aria-hidden="true"></i>
            <span class="menu-text"> Withdraw Request
        </a>
        <b class="arrow"></b>
    </li>
@endif

<li id="business_setting">
    <a href="{{ route('product.business-settings.create') }}">
        <i class="fa fa-gears menu-icon" aria-hidden="true"></i>
        <span class="menu-text"> Business Setting </span>
    </a>
    <b class="arrow"></b>
</li>
<li>
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <i class="menu-icon fa fa-sign-out"></i>
        {{ __('Signout') }}
    </a>
    <form id="logout-sform" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>
