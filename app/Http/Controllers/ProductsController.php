<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $data = compact('products');
        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;
        $data = compact('product');
        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hasFile = $request->hasFile('image') && $request->image->isValid();
        $product = new Product;
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->user_id = Auth::user()->id;

        if ($hasFile) {
            $extension = $request->image->extension();
            $product->extension = $extension;
        }

        if ($product->save()) {
            if ($hasFile) {
                $request->image->storeAs('img', $product->id.'.'.$extension);
            }
            return redirect('/products');
        } else {
            $data = compact('product');
            return redirect('/products/create', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $data = compact('product');
        return view('products.show', $data);
    }

    public function image($filename)
    {
        $path = storage_path('app/img/'.$filename);

        if (!File::exists($path)) abort(404);

        $file = File::get($path);
        $mimeType = File::mimeType($path);
        return Response::make($file, 200, [
            'Content-Type' => $mimeType
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $data = compact('product');
        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($product->save()) {
            return redirect('/products');
        } else {
            $data = compact('product');
            return view('products.edit', $data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('/products');
    }
}
