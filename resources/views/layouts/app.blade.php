<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   @include('includes.headLinks')

</head>


<body data-preloader="1">

    @include('includes.header')
    <div class="main-panel"  id="app">
    <section class="section-products">
        @include('includes.flashmessage')
        @yield('content')
    </section>
    </div>


    @include('includes.admin.adminFooter')
    @include('includes.javascripts')


</body>

</html>
