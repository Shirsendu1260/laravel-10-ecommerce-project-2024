<ul id="account-panel" class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('user_dashboard') }}" class="nav-link font-weight-bold" role="tab" aria-controls="tab-login"
            aria-expanded="false"><i class="fas fa-user-alt"></i>My Profile</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user_orders') }}" class="nav-link font-weight-bold" role="tab"
            aria-controls="tab-register" aria-expanded="false"><i class="fas fa-shopping-bag"></i>My Orders</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user_wishlist') }}" class="nav-link font-weight-bold" role="tab"
            aria-controls="tab-register" aria-expanded="false"><i class="fas fa-heart"></i>Wishlist</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user_change_password_page') }}" class="nav-link font-weight-bold" role="tab"
            aria-controls="tab-register" aria-expanded="false"><i class="fas fa-lock"></i>Change Password</a>
    </li>
    <li class="nav-item">
        <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();"
            class="nav-link font-weight-bold">
            <i class="fas fa-sign-out-alt text-danger"></i>Sign Out
        </a>
        <form id="logout-form" action="{{ route('user_sign_out') }}" method="post" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
