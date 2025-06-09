<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\RegisterRequest;
use App\Models\Season;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $products = Product::simplePaginate(6);
        return view('products',compact('products'));
    }

    public function show(Product $product)
    {
        $seasons = Season::all();
        return view('products.show' , compact('product', 'seasons'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function store(RegisterRequest $request)
    {
        $date = $request->validated();

        if($request->hasFile('image')){
            $path = $request->file('image')->store('images', 'public');
            $date['image'] = $path;
        }

        $product = Product::create([
            'name' => $date['name'],
            'price' => $date['price'],
            'description' => $date['description'],
            'image' => $date['image'],
        ]);

        $product->seasons()->attach($date['seasons']);

        return redirect()->route('products.index');
    }

    public function update(RegisterRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')){
            $path = $request->file('image')->store('images','public');
            $date['image'] = $path;
        } else {
            $date['image'] = $product->image;
        }

        $product->update([
            'name' => $date['name'],
            'price' => $date['price'],
            'description' => $date['description'],
            'image' => $date['image'],
        ]);

        $product->seasons()->sync($data['seasons']);

        return redirect()->route('products.show', $product->id);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

}
