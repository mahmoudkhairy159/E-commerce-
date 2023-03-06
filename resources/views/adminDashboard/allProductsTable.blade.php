@extends('layouts.adminApp')


@section('content')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Products</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item">{{__('messages.Tables')}}</li>
                    <li class="breadcrumb-item active"><a href="{{route('products.index')}}">{{__('messages.Products')}}</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @include('includes.flashmessage')


        <section class="section">
            <div class="row">

                <div class="col-lg-12">


                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-outline-primary m-2" href="{{route('products.create')}}">{{__('messages.New Product')}} <i class="fa-sharp fa-solid fa-plus"></i> </a>
                            <!-- Table with hoverable rows -->
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">{{__('messages.ID')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Picture')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Name')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Price')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Sale Price')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Type')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Actions')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                <tr >
                                    <th scope="row" class="text-center align-middle">{{$product->id}}</th>
                                    <td  class="text-center align-middle"><img src="{{asset('storage/images/products/'.$product->mainGallery)}}" style="width:100px; height:100px;" alt="..." class="rounded "></td>
                                    <td class="text-center align-middle">{{$product->name}}</td>
                                    <td class="text-center align-middle">{{$product->price}}</td>
                                    <td class="text-center align-middle">{{$product->salePrice}}</td>
                                    <td class="text-center align-middle">{{$product->type}}</td>
                                    <td class="text-center align-middle">
                                        <a class="btn btn-success " href="{{route('products.show',[$product->id])}}"><i class="fa-solid fa-eye"></i> </a>
                                        <a class="btn btn-success " href="{{route('products.edit',[$product->id])}}"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                        <form action="{{route('products.destroy',[$product->id])}}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button  type="submit" class="btn btn-danger " > <i class="fa-solid fa-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->
                        </div>
                    </div>

                </div>

                <ul class="pagination justify-content-center">{{$products->links()}}</ul>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
