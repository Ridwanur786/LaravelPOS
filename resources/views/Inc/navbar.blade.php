<ul class="nav nav-pills">
    <li class="nav-item active">
        <a class="nav-link" aria-current="page" href="#"><i class="bi bi-house-door"></i>Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}"><i class="bi bi-people"></i>Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}"><i class="bi bi-box2-fill"></i>Orders</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}" tabindex="-1" aria-disabled="true"><i class="bi bi-box-seam"></i>Product</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><i class="bi bi-truck-flatbed"></i>Suppliers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><i class="bi bi-truck"></i>Vendors</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><i class="bi bi-wallet2"></i>Transaction</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><i class="bi bi-box-seam"></i>Order Details</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><i class="bi bi-building"></i>Company</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><i class="bi bi-sliders2-vertical"></i>Settings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('products.barcode')}}" tabindex="-1" aria-disabled="true"><i class="bi bi-upc"></i>Barcode</a>
    </li>
</ul>
