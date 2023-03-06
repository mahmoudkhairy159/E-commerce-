<!doctype html>
<html lang="en">

<head>
    @include('includes.headLinks')

</head>

<body>
<div class="wrapper">
    @include('includes.admin.adminSidebar')

    <div class="main-panel" id="app">

        @include('includes.admin.adminNavbar')
            @yield('content')


        @include('includes.admin.adminFooter')


    </div>
</div>


</body>
@include('includes.Javascripts')


</html>
