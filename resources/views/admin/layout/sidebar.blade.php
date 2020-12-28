<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Kiosk<span>Xtra</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="{{ url('/admin/dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
       <li class="nav-item nav-category">Products</li>
      <li class="nav-item">
        <a data-toggle="collapse" href="#productcategory" role="button"  aria-controls="product" class="nav-link">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Product Category</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
         <div class="collapse" id="productcategory">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin/productcategories') }}" class="nav-link">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/productcategories/create') }}" class="nav-link">Create</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a data-toggle="collapse" href="#products" role="button"  aria-controls="product" class="nav-link">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Products</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
         <div class="collapse" id="products">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin/products') }}" class="nav-link">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/products/create') }}" class="nav-link">Create</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Orders</li>
      <li class="nav-item">
        <a href="{{ url('') }}" class="nav-link">
          <i class="link-icon" data-feather="briefcase"></i>
          <span class="link-title">Orders</span>
        </a>
      </li>
      <li class="nav-item nav-category">Users</li>
      <li class="nav-item">
        <a data-toggle="collapse" href="#users" role="button"  aria-controls="user" class="nav-link">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Users</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
         <div class="collapse" id="users">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin/users') }}" class="nav-link">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/users/create') }}" class="nav-link">Create</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Vendors</li>
      <li class="nav-item">
        <a data-toggle="collapse" href="#vendors" role="button"  aria-controls="vendors" class="nav-link">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Vendors</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
         <div class="collapse" id="vendors">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin/vendors') }}" class="nav-link">Index</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/vendors/approve') }}" class="nav-link">Approve Products</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>
