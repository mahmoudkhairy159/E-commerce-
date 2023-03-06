@extends('layouts.app')

@section('content')
    <section class="section-products">
        <div class="container">
            <div class="row  justify-content-center text-center ">
                <div class="col-md-8 col-lg-6 mb-3 ">

                    <h3 class="h4 text-opacity-50 " style="color:#fe302f;">{{__('messages.Featured Product')}}</h3>
                    <h2 class="h2 ">{{__('messages.Newest Products')}}</h2>
                </div>
                <div class="container row mb-4 justify-content-center">
                    <ul class="nav nav-pills nav-justified justify-content-center col-10 mb-3" style="background-color:#D9DBE1;">
                        <li class="nav-item col" style="color:#4B4E58">
                            <a  style="color:#4B4E58;font-weight: bold "
                               href="{{route('indexUser')}}">{{__('messages.All Products')}}</a>
                        </li>
                        <li class="nav-item col">
                            <a  style="color:#4B4E58; font-weight: bold"
                               href="{{route('indexNewestProducts')}}">{{__('messages.Newest')}}</a>
                        </li>
                        <li class="nav-item col">
                            <a  style="color:#4B4E58;font-weight: bold"
                               href="{{route('indexLowestPriceProducts')}}">{{__('messages.Lowest Price')}}</a>
                        </li>
                        <li class="nav-item col">
                            <a style="color:#4B4E58;font-weight:bold"
                               href="{{route('indexHighestPriceProducts')}}">{{__('messages.Highest Price')}}</a>
                        </li>
                        <li class="nav-item col activeee">
                            <a style="color:#4B4E58;font-weight: bold"
                               href="{{route('indexMenProducts')}}">{{__('messages.Men')}}</a>
                        </li>
                        <li class="nav-item col">
                            <a  style="color:#4B4E58;font-weight: bold"
                               href="{{route('indexWomenProducts')}}">{{__('messages.Women')}}</a>
                        </li>
                        <li class="nav-item col" >
                            <a  style="color:#4B4E58;font-weight: bold"
                               href="{{route('indexKidsProducts')}}">{{__('messages.Kids')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Single Product -->
            @foreach($menProducts as $product)
                <div class="col-md-6 col-lg-4 col-xl-3 text-center">
                    <div id="product-1" class="single-product">
                        <div class="part-1 ">
                            <img src="{{asset('storage/images/products/'.$product->mainGallery)}}"
                                 class="card-img-top w-450 h-300" alt="...">
                            <ul>
                                <li>
                                    <form action="{{route('addToCart')}}" method="post">
                                        @csrf
                                        <input hidden type="text" name="productId" value=" {{ $product->id}} ">
                                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                </li>
                                <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                <li><a href="{{route('showUser',[$product->id])}}"><i class="fas fa-expand"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">{{$product->name}}</h3>
                            @if($product->salePrice)
                                <h4 class="product-old-price">${{$product->price}}</h4>
                                <h4 class="product-price">${{$product->salePrice}}</h4>
                            @else
                                <h4 class="product-price">${{$product->price}}</h4>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <ul class="pagination justify-content-center">{{$menProducts->links()}}</ul>
        </div>
    </section>
@endsection
