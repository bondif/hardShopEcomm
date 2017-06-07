<nav class="navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <h1>
            <a class="navbar-brand" href="{{ route('admin_root_path') }}">
                <img src="{{ Storage::url('LogoHardShop_thumbnail.png') }}">
            </a>
        </h1>
    </div>
    <div class="top-height border-bottom">

        <a href="#" class="drop-men">
            <span class=" name-caret">{{ session('username') }}</span>
            <img src="{{ Storage::url('images/' . session('image')) }}">
        </a>
        <div class="clearfix"></div>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="{{ route('admin_root_path') }}" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                    </li>

                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-th-large nav_icon"></i> <span class="nav-label">Categories</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ route('categories.index') }}" class=" hvr-bounce-to-right"> <i class="fa fa-eye nav_icon"></i>Show Categories</a></li>

                            <li><a href="{{ route('categories.create') }}" class=" hvr-bounce-to-right"><i class="fa fa-plus nav_icon"></i>Add a Category</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-laptop nav_icon"></i> <span class="nav-label">Products</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ route('products.index') }}" class=" hvr-bounce-to-right"> <i class="fa fa-eye nav_icon"></i>Show Products</a></li>
                            <li><a href="{{ route('products.create') }}" class=" hvr-bounce-to-right"><i class="fa fa-plus-circle nav_icon"></i>Add a Product</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class=" hvr-bounce-to-right"><i class="fa fa-sign-out nav_icon"></i> <span class="nav-label">Logout</span> </a>
                    </li>

                </ul>
            </div>
        </div>
</nav>