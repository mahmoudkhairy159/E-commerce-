@if($relatedProducts)
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">{{__('messages.Related Products')}}</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
            @foreach($relatedProducts as $relatedProduct)
            <div class="col-3 mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img cclass="card-img-top w-450 h-300" src="{{asset('storage/images/products/'.$relatedProduct->mainGallery)}}" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-1">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{$relatedProduct->name}}</h5>
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <div class="mb-2">
                                <span class="text-decoration-line-through">$45.00</span>
                                <span style="color:#fe302f;">${{$product->price}}</span>
                            </div>
                            <div class="card-footer p-1 pt-0 border-top-0 bg-transparent">
                                <form action="{{route('addToCart')}}" method="post">
                                    @csrf
                                    <input hidden type="text" name="productId" value=" {{ $product->id}} ">

                                    <div class="d-flex  justify-content-center text-center">

                                        <button  class="btn btn-outline-dark flex-shrink-0" type="submit">
                                            <i class="bi-cart-fill me-1" style="color:#017019"></i>
                                           {{__('messages.Add to cart')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Product actions-->

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
