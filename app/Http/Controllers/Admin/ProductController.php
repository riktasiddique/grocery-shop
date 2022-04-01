<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $subCategories = SubCategory::all();
        $mainCategories = MainCategory::all();
        return view('admin.all-product.index', compact('products', 'subCategories', 'mainCategories'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image1' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        $user = Auth::user();
        $image_1 = $request->file('image1');
        $path_1 = $image_1? Storage::url($request->file('image1')->store('public/image/'. $user->id)) : ' ';
        // return $path_1;

        $product = new Product();
        // $product->title = $request->title;
        $product->user_id = $user->id;
        $product->main_category_id = $request->main_category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->image1 = $path_1;
        $product->save();
        return back()->with('success', 'The product created successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.all-product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $subCategories = SubCategory::all();
        $mainCategories = MainCategory::all();
        return view('admin.all-product.edit', compact('product', 'subCategories', 'mainCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //    return $request->all();
    $validated = $request->validate([
        'image1' => 'required',
        'price' => 'required',
        'quantity' => 'required',
    ]);
    $user = Auth::user();
    $image_1 = $request->file('image1');
    $path_1 = $image_1? Storage::url($request->file('image1')->store('public/image/'. $user->id)) : ' ';
    // return $path_1;

    $product = Product::findOrFail($id);
    // $product->title = $request->title;
    $product->user_id = $user->id;
    $product->main_category_id = $request->main_category_id;
    $product->sub_category_id = $request->sub_category_id;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->image1 = $path_1;
    // return $request->all();
    $product->save();
    return back()->with('success', 'The product created successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'The product delated successfuly!');
    }
}
