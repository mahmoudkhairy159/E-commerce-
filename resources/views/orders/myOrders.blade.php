@extends('layouts.app')

@section('content')
    <div class="section-lg">
        <div class="container">
            <div class="row col-spacing-40">
                @foreach($orders as $order)
                    <div
                        class=" container justify-content-center col-12 col-xl-8 border border-secondary ">
                        <div class="  row alert-heading bg-secondary">
                            <div class="col-4"> {{__('messages.Order ID')}}:</div>
                            <div class="col-2">{{$order->id}}</div>
                        </div>
                        <hr>
                        <div class="  container justify-content-center row">
                            <div class="col-4 "><h5>{{__('messages.Total Price')}}: </h5>
                            </div>
                            <div class="col-2">${{$order->totalPrice}} </div>
                            <div class="col-4"><h5>{{__('messages.Order Status')}}:</h5>
                            </div>
                            <div class="col-2">{{$order->status}}</div>
                        </div>

                        <div class="container justify-content-center  row">
                            <div class="col-4"><h5>{{__('messages.Payment Method')}}:</h5>
                            </div>
                            <div class="col-2">{{$order->paymentMethod}}</div>
                            <div class="col-4"><h5>{{__('messages.Payment Status')}}:</h5>
                            </div>
                            <div class="col-2">{{$order->paymentStatus}}</div>
                        </div>
                        <div class="container justify-content-center  row">
                            <div class="col-4"><h5>{{__('messages.Placement Date')}}:</h5>
                            </div>
                            <div class="col-2">{{$order->created_at}}</div>
                            <div class="col-4"><h5>{{__('messages.Delivery Date')}}:</h5>
                            </div>
                            <div class="col-2">{{$order->deliveryDate}}</div>
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
                                        <a href="{{route('showUser', $product->id)}}"><img
                                                class="img-sm"
                                                src="{{asset('storage/images/products/'.$product->mainGallery)  }}"></a>
                                    </td>
                                    <td>{{ $product->name_en }}</td>
                                    <td>
                                        @if($product->salePrice)
                                            ${{ $product->salePrice }}
                                        @else
                                            ${{ $product->price }}
                                        @endif
                                    </td>
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
                                        @endif
                                    </td>
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
@endsection
