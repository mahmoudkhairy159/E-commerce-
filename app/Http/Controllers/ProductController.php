<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductController extends Controller
{
    /**
     * retrieve All the products in the database
     *
     * @return $products for admin guard view
     */
    public function index()
    {
        $products = Product::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price','salePrice', 'type', 'mainGallery')->paginate(paginationCount);
        return view('adminDashboard.allProductsTable')->with('products', $products);

    }

    /**
     * retrieve uproducts for  guard user view
     */
    public function indexUser()
    {
        $products = Product::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price','salePrice', 'type', 'mainGallery')->paginate(paginationCount);
        return view('products.userAllProducts')->with('products', $products);
    }
    public function indexNewestProducts()
    {
        $newestProducts = Product::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price','salePrice', 'type', 'mainGallery')->orderBy('created_at','desc')->paginate(paginationCount);
        return view('products.userNewestProducts')->with('newestProducts', $newestProducts);
    }
    public function indexLowestPriceProducts()
    {
        $lowestPriceProducts = Product::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price','salePrice', 'type', 'mainGallery')->orderBy('price','asc')->paginate(paginationCount);
        return view('products.userLowestPriceProducts')->with('lowestPriceProducts', $lowestPriceProducts);
    }
    public function indexHighestPriceProducts()
    {
        $highestPriceProducts = Product::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price','salePrice', 'type', 'mainGallery')->orderBy('price','desc')->paginate(paginationCount);
        return view('products.userHighestPriceProducts')->with('highestPriceProducts',$highestPriceProducts);
    }

    public function indexMenProducts()
    {
        $menProducts = Product::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price','salePrice', 'type', 'mainGallery')->where('type','0')->paginate(paginationCount);
        return view('products.userMenProducts')->with('menProducts',$menProducts);
    }
    public function indexWomenProducts()
    {
        $womenProducts = Product::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price','salePrice', 'type', 'mainGallery')->where('type','1')->paginate(paginationCount);
        return view('products.userWomenProducts')->with('womenProducts',$womenProducts);
    }
    public function indexKidsProducts()
    {
        $kidsProducts = Product::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price','salePrice', 'type', 'mainGallery')->where('type','2')->paginate(paginationCount);
        return view('products.userKidsProducts')->with('kidsProducts',$kidsProducts);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        return view('products.createProduct');
    }


    public function store(Request $request)
    {
        Product::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'salePrice' => $request->salePrice,
            'type' => $request->type,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'mainGallery' => $request->mainGallery->store($request->name_en ,'products'),
            'gallery1' => $request->gallery1->store($request->name_en,'products'),
            'gallery2' => $request->gallery2->store( $request->name_en,'products'),
            'gallery3' => $request->gallery3->store($request->name_en, 'products'),
            'admin_id' => $request->admin_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the product details to admin .
     *
     * @param int $id
     * @return $product
     */
    public function show($id)
    {
        $product=Product::find($id);
        if(!$product){
            return redirect()->back()->with('error','The Product Does not Exist');
        }
        return view('products.adminProduct')->with('product',$product);
    }

    /**
     * Display the product details to user .
     *
     * @param int $id
     * @return $product
     */
    public function showUser($id)
    {

        $product=Product::where('id',$id)->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','description_'.LaravelLocalization::getCurrentLocale().' as description', 'price','salePrice', 'type', 'mainGallery','gallery1','gallery2','gallery3')->first();

        $relatedProducts=Product::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price','salePrice', 'mainGallery')->where('type',$product->type)->limit(4)->get();
        if(!$product){
            return redirect()->back()->with('error','The Product Does not Exist');
        }
        return view('products.userProduct')->with(['product'=>$product, 'relatedProducts'=>$relatedProducts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return $product
     */
    public function edit($id)
    {
        $product=Product::find($id);
        if(!$product){
           return redirect()->back()->with('error','The Product Does not Exist');
        }
        return view('products.editProduct')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return
     */
    public function update(Request $request, $id)
    {
        $product=Product::find($id);
        if(!$product){
            return redirect()->back()->with('error','The Product Does not Exist');
        }


        if($request->hasFile('mainGallery')){
            Storage::disk('products')->delete($product->mainGallery);
            $product->update([
                'mainGallery' => $request->mainGallery->store($request->name_en,'products'),
            ]);
        }
        if($request->hasFile('gallery1')){
            Storage::disk('products')->delete($product->gallery1);
            $product->update([
                'gallery1' => $request->gallery1->store($request->name_en, 'products'),
            ]);
        }
        if($request->hasFile('gallery2')){
            Storage::disk('products')->delete($product->gallery2);
            $product->update([
                'gallery2' => $request->gallery2->store( $request->name_en, 'products'),
            ]);
        }
        if($request->hasFile('gallery3')){
            Storage::disk('products')->delete($product->gallery3);
            $product->update([
                'gallery3' => $request->gallery3->store($request->name_en,'products'),
            ]);
        }

        if($product->name_en !== $request->name_en){
            Storage::disk('products')->deleteDirectory($product->name_en);
        }


        $product->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'salePrice' => $request->salePrice,
            'type' => $request->type,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'admin_id' => $request->admin_id,
        ]);


        session()->flash('success','Product updated successfully!');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        if(!$product){
            return redirect()->back()->with('error','The Product Does not Exist');
        }

        Storage::disk('products')->delete($product->mainGallery);
        Storage::disk('products')->delete($product->gallery1);
        Storage::disk('products')->delete($product->gallery2);
        Storage::disk('products')->delete($product->gallery3);
        $dir = $product->name ;
        Storage::disk('products')->deleteDirectory($product->name_en);
        $product->delete();
        session()->flash('success','Product deleted successfully!');
        return redirect()->route('products.index');

    }

    public function searchForProduct(Request $request){


        $products=Product::where($request->searchType,$request->searchValue)->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name', 'price', 'type', 'mainGallery')->paginate(paginationCount);
        if(!$products){
            return redirect()->back()->with('error','The Product Does not Exist');
        }
        return view('adminDashboard.allProductsTable')->with('products', $products);

    }
}
