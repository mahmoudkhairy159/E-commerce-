<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="/admin/dashboard">
                <i class="bi bi-grid"></i>
                <span>{{__('messages.Dashboard')}}</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>{{__('messages.Tables')}}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('products.index')}}">
                        <i class="bi bi-circle"></i><span>{{__('messages.Products')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">
                        <i class="bi bi-circle"></i><span>{{__('messages.Customers')}}</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->


        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admins.show',Auth::id())}}">
                <i class="bi bi-person"></i>
                <span>{{__('messages.Profile')}}</span>
            </a>
        </li><!-- End Profile Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
