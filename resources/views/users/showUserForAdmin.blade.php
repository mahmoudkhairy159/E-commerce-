@extends('layouts.adminApp')


@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('messages.Profile')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section profile">
            <div class="row">

                <div class="col-xl-12">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">{{__('messages.Overview')}}</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#showUserCartList">{{__('messages.Show CartList')}}</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#showUserOrders">{{__('messages.Show Orders')}}</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">{{__('messages.Profile Information')}}</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">{{__('messages.ID')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$user->id}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">{{__('messages.Name')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">{{__('messages.E-Mail')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">{{__('messages.Phone')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$user->phone}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">{{__('messages.Address')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$user->address}}</div>
                                    </div>


                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="showUserCartList">

                                    @isset($pendingOrder)
                                        <div class="container">
                                            <div class="row col-spacing-40">
                                                <div
                                                    class=" container justify-content-center col-12 col-xl-8 border border-secondary ">
                                                    <div class="  row alert-heading bg-secondary">
                                                        <div class="col-4"> {{__('messages.Order ID')}}:</div>
                                                        <div class="col-2">{{$pendingOrder->id}}</div>
                                                    </div>
                                                    <hr>
                                                    <div class="  container justify-content-center row">
                                                        <div class="col-4 "><h5>{{__('messages.Total Price')}}: </h5>
                                                        </div>
                                                        <div class="col-2">${{$pendingOrder->totalPrice}} </div>
                                                        <div class="col-4"><h5>{{__('messages.Order Status')}}:</h5>
                                                        </div>
                                                        <div class="col-2">{{$pendingOrder->status}}</div>
                                                    </div>

                                                    <div class="container justify-content-center  row">
                                                        <div class="col-4"><h5>{{__('messages.Payment Method')}}:</h5>
                                                        </div>
                                                        <div class="col-2">{{$pendingOrder->paymentMethod}}</div>
                                                        <div class="col-4"><h5>{{__('messages.Payment Status')}}:</h5>
                                                        </div>
                                                        <div class="col-2">{{$pendingOrder->paymentStatus}}</div>
                                                    </div>
                                                    <hr>
                                                    <hr>

                                                    <table class="table cart-table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col">{{__('messages.Picture')}}</th>
                                                            <th scope="col">{{__('messages.Product')}}</th>
                                                            <th scope="col">{{__('messages.Price')}}</th>
                                                            <th scope="col">{{__('messages.Quantity')}}</th>
                                                            <th scope="col">{{__('messages.Subtotal')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($pendingOrder->products as $product)
                                                            <tr>
                                                                <th scope="row">

                                                                </th>
                                                                <td class="product-thumbnail">
                                                                    <a href="{{route('products.show', $product->id)}}"><img
                                                                            class="img-sm"
                                                                            src="{{asset('storage/images/products/'.$product->mainGallery)  }}"></a>
                                                                </td>
                                                                <td>{{ $product->name_en }}</td>
                                                                <td>
                                                                    @if($product->salePrice)
                                                                        ${{ $product->salePrice }}
                                                                    @else
                                                                        ${{ $product->price }}
                                                                    @endif</td>
                                                                </td>
                                                                <td>
                                                                    <form class="product-quantity">
                                                                        <div class="qnt">
                                                                            <var
                                                                                class="quantity">{{$pendingProductsQuantities[$pendingOrder->id]}}</var>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td>
                                                                    @if($product->salePrice)
                                                                        ${{ $product->salePrice * $pendingProductsQuantities[$pendingOrder->id] }}
                                                                    @else
                                                                        ${{ $product->price * $pendingProductsQuantities[$pendingOrder->id] }}

                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                        </div><!-- end row -->


                                    @endisset

                                </div>


                                <div class="tab-pane fade pt-3" id="showUserOrders">
                                    <div class="container">
                                        <div class="row col-spacing-40">
                                            @foreach($orders as $order)
                                                <div
                                                    class=" container justify-content-center col-12 col-xl-8 border border-secondary ">
                                                    <div class="  row alert-heading bg-secondary">
                                                        <div class="col-3"> {{__('messages.Order ID')}}:</div>
                                                        <div class="col-3">{{$order->id}}</div>
                                                    </div>
                                                    <hr>
                                                    <div class="  container justify-content-center row">
                                                        <div class="col-3 "><p>{{__('messages.Total Price')}}: </p>
                                                        </div>
                                                        <div class="col-3">${{$order->totalPrice}} </div>
                                                        <div class="col-3"><p>{{__('messages.Order Status')}}:</p>
                                                        </div>
                                                        <div class="col-3">{{$order->status}}</div>
                                                    </div>

                                                    <div class="container justify-content-center  row">
                                                        <div class="col-4"><p>{{__('messages.Payment Method')}}:</p>
                                                        </div>
                                                        <div class="col-2">{{$order->paymentMethod}}</div>
                                                        <div class="col-3"><p>{{__('messages.Payment Status')}}:</p>
                                                        </div>
                                                        <div class="col-3">{{$order->paymentStatus}}</div>
                                                    </div>
                                                    <div class="container justify-content-center  row">
                                                        <div class="col-3"><p>{{__('messages.Placement Date')}}:</p>
                                                        </div>
                                                        <div class="col-3">{{$order->created_at}}</div>
                                                        <div class="col-3"><p>{{__('messages.Delivery Date')}}:</p>
                                                        </div>
                                                        <div class="col-3">{{$order->deliveryDate}}</div>
                                                    </div>
                                                    <hr>
                                                    <hr>

                                                    <table class="table cart-table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col">{{__('messages.Picture')}}</th>
                                                            <th scope="col">{{__('messages.Product')}}</th>
                                                            <th scope="col">{{__('messages.Price')}}</th>
                                                            <th scope="col">{{__('messages.Quantity')}}</th>
                                                            <th scope="col">{{__('messages.Subtotal')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($order->products as $product)
                                                            <tr>
                                                                <th scope="row">

                                                                </th>
                                                                <td class="product-thumbnail">
                                                                    <a href="{{route('products.show', $product->id)}}"><img
                                                                            class="img-sm"
                                                                            src="{{asset('storage/images/products/'.$product->mainGallery)  }}"></a>
                                                                </td>
                                                                <td>{{ $product->name_en }}</td>
                                                                <td>
                                                                    @if($product->salePrice)
                                                                        ${{ $product->salePrice }}
                                                                    @else
                                                                        ${{ $product->price }}
                                                                    @endif</td>
                                                                <td>
                                                                    <form class="product-quantity">
                                                                        <div class="qnt">
                                                                            <var
                                                                                class="quantity">{{$productsQuantities[$order->id.$product->id]}}</var>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td>
                                                                    @if($product->salePrice)
                                                                        ${{ $product->salePrice * $productsQuantities[$order->id.$product->id]}}
                                                                    @else
                                                                        ${{ $product->price * $productsQuantities[$order->id.$product->id]}}
                                                                    @endif</td>
                                                            </tr>

                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr>
                                                <hr>
                                            @endforeach

                                        </div>
                                    </div><!-- end row -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
