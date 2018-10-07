<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Product;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->wantsJson()){
            $products = Product::with('photos','options')->get();
            return $products;
        }

        if (request()->category){

            $products = Product::with('categories')->whereHas('categories', function ($query){
                $query->where('slug', request()->category);

            })->paginate(4);


        }else{
            $products = Product::paginate(12);
        }

        $categories = Category::all();




        return view('product.index', compact('products', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $file = $request->file('file');
        $fileName = time(). $file->getClientOriginalName();
        $path = 'flyers/photos/'.$fileName;

        $img = Image::make($file)
            ->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();



        ImageOptimizer::optimize($file, $path);

        $product = Product::create([

            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,

        ]);

        $product->photo()->create(['path' => "/product/photos/{$fileName}"]);
        return back()->with('success','Uploaded');



    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

//        $product = Product::find($id);

        $product = Product::where('slug','=',$slug)->firstOrFail();

        return view('product.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

//                if(!$request->file('file')) {flash()->error('Please choose a file ','');return back();}


        try{
            $request->validate([ 'file'=> 'required|mimes:jpg,png,bmp,jpeg,svg|max:3000']);
            $file = $request->file('file');
            $fileName = time(). $file->getClientOriginalName();
            $path = 'product/photos/'.$fileName;

            $img = Image::make($file)
            ->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();



            ImageOptimizer::optimize($file, $path);

//            $product = Product::where('id', $request->id)->firstOrFail();

            $product->photos()->forceCreate([
                'path' => "/product/photos/{$fileName}",
                'product_id' => request()->product_id
            ]);
            flash()->success('Uploaded successfully', '');
            return back();


        }catch (\Exception $e){
            flash()->error($e->getMessage(), '');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }



}
