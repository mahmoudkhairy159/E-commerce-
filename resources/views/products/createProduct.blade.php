@extends('layouts.adminApp')
@section('content')



< class="content">
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{__('messages.Add New Product')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item">{{__('messages.Tables')}}</li>
                    <li class="breadcrumb-item active">{{__('messages.Products')}}</li>
                    <li class="breadcrumb-item active">{{__('messages.New Product')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{__('messages.The product will be added by: ')}} {{ Auth::guard('admin')->user()->name}}</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                                @csrf
                                <input hidden type="text" name="admin_id" value=" {{ Auth::guard('admin')->id()}} ">

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.Arabic Name')}}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.Enter Arabic Name')}}">
                                    </div>
                                    <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.English Name')}}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="name_en" placeholder="{{__('messages.Enter English Name')}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.Price')}} </label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control"  name="price" placeholder="{{__('messages.Enter Product Price')}}">
                                    </div>
                                    <label for="inputText"
                                           class="col-sm-2 col-form-label">{{__('messages.Sale Price')}}</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" name="salePrice"
                                               placeholder="optional">
                                    </div>
                                    <hr>
                                    <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.Type')}}</label>
                                    <div class="col-sm-4">
                                            <select class="form-select" aria-label="Default select example" name="type">
                                                <option selected value="0">{{__('messages.Men')}}</option>
                                                <option value="1">{{__('messages.Women')}}</option>
                                                <option value="2">{{__('messages.Kids')}}</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.English Description')}}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px"  name="description_en" placeholder="{{__('messages.Here can be your product description in English')}}"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.Arabic Description')}}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px"  name="description_ar" placeholder=" {{__('messages.Here can be your product description in Arabic')}}"></textarea>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.Main Picture')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="mainGallery" id="formFile">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.SubPicture #1')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file"name="gallery1" id="formFile">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">{{__('messages.SubPicture #2')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" name="gallery2">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.SubPicture #3')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="gallery3" id="formFile">
                                    </div>
                                </div>



                                <div class="row mb-3 justify-content-center">
                                        <button type="submit" class="btn btn-primary col-4">{{__('messages.Add Product')}} <i class="fa-sharp fa-solid fa-plus"></i></button>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main>
@endsection
