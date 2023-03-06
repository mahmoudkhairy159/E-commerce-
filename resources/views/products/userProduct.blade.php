@extends('layouts.app')

@section('content')

    <section class="section product">
        <div class="row card-group">

            <div class=" col-xl-5 card">
                <div class="card-body product-card pt-4 d-flex flex-column align-items-center ">
                    <div class="main_image">
                        <img src="{{asset('storage/images/products/'.$product->mainGallery)}}" id="main_product_image"
                             width="350">
                    </div>
                    <div class="thumbnail_images">
                        <ul id="thumbnail">
                            <li>
                                <img onclick="changeImage(this)"
                                     src="{{asset('storage/images/products/'.$product->mainGallery)}}" width="70">
                            </li>
                            <li>
                                <img onclick="changeImage(this)"
                                     src="{{asset('storage/images/products/'.$product->gallery1)}}" width="70">
                            </li>
                            <li>
                                <img onclick="changeImage(this)"
                                     src="{{asset('storage/images/products/'.$product->gallery2)}}" width="70">
                            </li>
                            <li>
                                <img onclick="changeImage(this)"
                                     src="{{asset('storage/images/products/'.$product->gallery3)}}" width="70">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class=" col-xl-7 card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#product-overview">
                                {{__('messages.Overview')}}
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link btn-outline-dark flex-shrink-0" type="button" data-bs-toggle="tab"
                                    data-bs-target="#comments">
                                <i class="bi-cart-fill me-1"
                                   style="color:#017019"></i> {{__('messages.Customers Opinions')}}
                            </button>
                        </li>


                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active product-overview text-center " id="product-overview">
                            <h1 class="display-5 fw-bolder ">{{$product->name}}</h1>
                            <div class="fs-5 mb-5">
                                @if($product->salePrice)
                                    <span class="text-decoration-line-through">${{$product->price}}</span>
                                    <span style="color:#fe302f;">${{$product->salePrice}}</span>
                                @else
                                    <span style="color:#fe302f;">${{$product->price}}</span>
                                @endif
                            </div>
                            @if($product->description)
                            <p class="fst-italic"><strong>{{__('messages.Description')}}
                                    : </strong> {{$product->description}}</p>
                            @endif

                            <form action="{{route('addToCart')}}" method="post">
                                @csrf
                                <input hidden type="text" name="productId" value=" {{ $product->id}} ">

                                <div class="d-flex  justify-content-center text-center">

                                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                        <i class="bi-cart-fill me-1" style="color:#017019"></i>
                                        {{__('messages.Add to cart')}}
                                    </button>
                                </div>
                            </form>


                        </div>

                        <div class="tab-pane fade addToCart pt-3" id="comments">
                            <p>comments</p>


                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </section>
    @include('includes.relatedProducts')




@endsection
