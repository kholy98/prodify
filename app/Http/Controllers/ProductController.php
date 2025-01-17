<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // $product = Product::find(34);
        // dd($product->getFirstMediaUrl('images'));

        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'images' => 'array',
        ]);
    
        $product = Product::create($request->only(['name', 'description', 'price']));
    
        if ($request->has('images')) {
            foreach ($request->images as $imagePath) {
                $product->addMedia(storage_path('app/public/' . $imagePath))->toMediaCollection('images');            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function upload(Request $request)
    {dd($request->all(), $request->file('file'));
        if ($request->hasFile('file')) {dd($request->all(), $request->file('file'));
            $path = $request->file('file')->store('temp', 'public');
            return response()->json(['path' => $path], 200);
        }

        return response()->json(['error' => 'File upload failed'], 400);
    }
}
