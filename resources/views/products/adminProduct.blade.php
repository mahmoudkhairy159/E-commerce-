@extends('layouts.Adminapp')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{$product->name}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item">{{__('messages.Tables')}}</li>
                    <li class="breadcrumb-item "><a href="{{route('products.index')}}">{{__('messages.Products')}}</a>
                    </li>
                    <li class="breadcrumb-item active"><a
                            href="{{route('products.show',[$product->id])}}">{{__('messages.View Product')}}</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section product">
            <div class="row card-group">

                <div class=" col-xl-5 card">
                    <div class="card-body product-card pt-4 d-flex flex-column align-items-center ">
                        <div class="main_image">
                            <img src="{{asset('storage/images/products/'.$product->mainGallery)}}"
                                 id="main_product_image" width="350">
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
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#product-edit">
                                    {{__('messages.Edit Product')}}
                                </button>
                            </li>

                            <li class="nav-item  ">
                                <form action="{{route('products.destroy',[$product->id])}}" method="post"
                                      class=" d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger ">
                                        {{__('messages.Delete Product')}} <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active product-overview" id="product-overview">
                                <div class="row">
                                    <div class="col-5 "><h6> {{__('messages.ID')}}</h6></div>
                                    <div class="col-7"><p>{{$product->id}}</p></div>
                                </div>
                                <hr class="dropdown-divider">
                                <div class="row">
                                    <div class="col-5 "><h6>{{__('messages.Arabic Name')}}</h6></div>
                                    <div class="col-7"><p>{{$product->name_ar}}</p></div>
                                </div>
                                <hr class="dropdown-divider">
                                <div class="row">
                                    <div class="col-5 "><h6>{{__('messages.English Name')}}</h6></div>
                                    <div class="col-7"><p>{{$product->name_en}}</p></div>
                                </div>
                                <hr class="dropdown-divider">

                                @if($product->description_en)
                                    <div class="row">
                                        <div class="col-5  label ">
                                            <h6>{{__('messages.English Description')}}</h6>
                                        </div>
                                        <div class="col-7"><p>{{$product->description_en}}</p></div>
                                    </div>
                                @endif
                                <hr class="dropdown-divider">
                                @if($product->description_ar)
                                    <div class="row">
                                        <div class="col-5 label ">
                                            <h6>{{__('messages.Arabic Description')}}</h6>
                                        </div>
                                        <div class="col-7"><p>{{$product->description_ar}}</p></div>
                                    </div>
                                    <hr class="dropdown-divider">
                                @endif
                                <div class="row">
                                    <div class="col-5"><h6>{{__('messages.Price')}}</h6></div>
                                    <div class="col-7"><p>${{$product->price}}</p></div>
                                </div>
                                @if($product->salePrice)
                                    <div class="row">
                                        <div class="col-5"><h6>{{__('messages.Sale Price')}}</h6></div>
                                        <div class="col-7"><p>${{$product->salePrice}}</p></div>
                                    </div>
                                @endif
                                <hr class="dropdown-divider">
                                <div class="row ">
                                    <div class="col-5"><h6>{{__('messages.Type')}}</h6></div>
                                    <div class="col-7"><p>{{$product->type}}</p></div>
                                </div>


                            </div>

                            <div class="tab-pane fade product-edit pt-3" id="product-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST" action="{{route('products.update',[$product->id])}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input hidden type="text" name="admin_id" value=" {{ Auth::guard('admin')->id()}} ">

                                    <div class="row mb-3">
                                        <label for="inputText"
                                               class="col-sm-4 col-form-label">{{__('messages.Arabic Name')}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="name_ar"
                                                   value="{{$product->name_ar}}">
                                        </div>
                                        <label for="inputText"
                                               class="col-sm-4 col-form-label">{{__('messages.English Name')}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="name_en"
                                                   value="{{$product->name_en}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                               class="col-sm-2 col-form-label">{{__('messages.Price')}}</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="price"
                                                   placeholder="Enter Product Price" value="{{$product->price}}">
                                        </div>
                                        <label for="inputText"
                                               class="col-sm-2 col-form-label">{{__('messages.Sale Price')}}</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="salePrice"
                                                   placeholder="optional"
                                                   value="{{($product->salePrice)?$product->salePrice:null}}">
                                        </div>
                                        <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.Type')}}
                                        </label>
                                        <div class="col-sm-4">
                                            <select class="form-select" aria-label="Default select example"
                                                    name="type">
                                                <option selected value="0">{{__('messages.Men')}}</option>
                                                <option value="1">{{__('messages.Women')}}</option>
                                                <option value="2">{{__('messages.Kids')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword"
                                               class="col-sm-4 col-form-label">{{__('messages.English Description')}}</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" style="height: 100px" name="description_en"
                                                      placeholder="{{__('messages.Here can be your product description in English')}}">{{($product->description_en)?$product->description_en:null}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword"
                                               class="col-sm-4 col-form-label">{{__('messages.Arabic Description')}}</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" style="height: 100px" name="description_ar"
                                                      placeholder="{{__('messages.Here can be your product description in Arabic')}}">{{($product->description_ar)?$product->description_ar:null}}</textarea>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-4 col-form-label">{{__('messages.Main Picture')}}</label>
                                        <div class="col-sm-8 ">
                                            <input class="form-control" type="file" name="mainGallery" id="formFile">
                                            <img src="{{asset('storage/images/products/'.$product->mainGallery)}}"
                                                 style="width:100px; height:100px;" alt="..." class="rounded ">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-4 col-form-label">{{__('messages.SubPicture #1')}}</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="file" name="gallery1" id="formFile">
                                            <img src="{{asset('storage/images/products/'.$product->gallery1)}}"
                                                 style="width:100px; height:100px;" alt="..." class="rounded ">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-4 col-form-label">{{__('messages.SubPicture #2')}}</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="file" id="formFile" name="gallery2">
                                            <img src="{{asset('storage/images/products/'.$product->gallery2)}}"
                                                 style="width:100px; height:100px;" alt="..." class="rounded ">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-4 col-form-label">{{__('messages.SubPicture #3')}}</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="file" name="gallery3" id="formFile">
                                            <img src="{{asset('storage/images/products/'.$product->gallery3)}}"
                                                 style="width:100px; height:100px;" alt="..." class="rounded ">

                                        </div>
                                    </div>

                                    <div class="row mb-3 justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success col-4">{{__('messages.Edit Product')}} <i
                                                class="fa-solid fa-pen-to-square"></i></button>
                                    </div>

                                </form><!-- End General Form Elements -->


                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </section>

    </main><!-- End #main -->
@endsection
