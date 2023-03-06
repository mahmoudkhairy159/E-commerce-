@extends('layouts.app')

@section('content')
    <section class="">
        <div class="container-fluid">
            <div class="row">
                <aside class="col-lg-9">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-borderless table-shopping-cart  ">
                                <thead class="text-muted">
                                <tr class=" text-uppercase">
                                    <th scope="col">{{__('messages.Product')}}</th>
                                    <th scope="col w-" >{{__('messages.Quantity')}}</th>
                                    <th scope="col">{{__('messages.Price')}}</th>
                                    <th scope="col" class="text-right d-none d-md-block" ></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($order->products as $product )

                                    <tr>
                                        <td>
                                            <figure class="itemside align-items-center">
                                                <div class="aside"><img
                                                        src="{{asset('storage/images/products/'.$product->mainGallery)}}"
                                                        class="img-sm"></div>
                                                <figcaption class="info"><a href="{{route('showUser',[$product->id])}}"
                                                                            class="title text-dark"
                                                                            data-abc="true">{{$product->name_en}}</a>
                                                    <p class="text-muted small">SIZE: L <br> Brand: MAXTRA</p>
                                                </figcaption>
                                            </figure>
                                        </td>
                                        <td>

                                            <div class="price-wrap  align-items-center">

                                                <form method="post" action="{{route('editProductQuantity')}}">
                                                    @csrf
                                                    <input type="hidden" name="productId" value="{{$product->id}}">
                                                    <input type="hidden" name="orderId" value="{{$order->id}}">
                                                    <input type="number" class="rounded" name="productQuantity" value="{{$productsQuantities[$order->id.$product->id]}}" style="width:12%; height:35px;   ">
                                                    <input type="submit" class="rounded-pill border-1" value="{{__('messages.edit')}}" style=" width:12%; height:35px;  padding:5px; background-color:#F44336; color:#f8f9fa">
                                                </form>
                                            </div>

                                        <td>
                                            @if($product->salePrice)
                                                <div class="price-wrap item-middle"><var
                                                        class="price">${{$product->salePrice * $productsQuantities[$order->id.$product->id] }}</var>
                                                </div>
                                            @else
                                                <div class="price-wrap"><var
                                                        class="price">${{$product->price * $productsQuantities[$order->id.$product->id] }}</var>
                                                </div>
                                            @endif

                                        </td>
                                        <td class="text-right d-none d-md-block">
                                            <a data-original-title="Save to Favorites" hreftitle="" href=""
                                               class="btn btn-light" data-toggle="tooltip" data-abc="true"> <i
                                                    class="fa fa-heart"></i></a>
                                            <a href="{{route('removeProductfromCartList',$product->id)}}"
                                               class="btn btn-light" data-abc="true"> <i class="fa-solid fa-xmark"></i></a>
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </aside>
                <aside class="col-lg-3">

                    <div class="card">
                        <div class="card-body">
                            <dl class="dlist-align">
                                <dt>{{__('messages.Total Price')}}:</dt>
                                <dd class="text-right ml-3"><var
                                        id="totalPrice">{{$totalPriceBeforeSale}}</var></dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>{{__('messages.Discount')}}:</dt>
                                <dd class="text-right text-danger ml-3">-{{$totalPriceBeforeSale-$totalPrice}}</dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>{{__('messages.Total After Sale')}}:</dt>
                                <dd class="text-right text-dark b ml-3"><strong>{{$totalPrice}}</strong></dd>
                            </dl>
                            <hr>

                            <form action="{{route('confirmOrder')}}" method="get">
                                @csrf
                                <dl class="dlist-align">
                                    <dt>{{__('messages.Choose Payment Method')}}:</dt>
                                </dl>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" value="0"
                                           id="Cash" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{__('messages.Cash')}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" value="1"
                                           id="VISA">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{__('messages.VISA')}}                                    </label>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-out btn-primary btn-square btn-main"
                                        data-abc="true">{{__('messages.Make a Purchase')}}
                                </button>
                            </form>

                            <a href="#" class="btn btn-out btn-success btn-square btn-main mt-2"
                               data-abc="true">{{__('messages.Continue Shopping')}}</a>
                        </div>
                    </div>
                    <div id="showVisaPaymentForm">
                    </div>
                </aside>
            </div>
        </div>
    </section>

@endsection
