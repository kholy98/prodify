<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        // $product = Product::find(34);
        // dd($product->getFirstMediaUrl('images'));

        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        $temporaryImages = TemporaryImage::all();

        if ($validator->fails()) {
            // Delete temporary images
            foreach($temporaryImages as $temporaryImage){
                Storage::disk('public')->deleteDirectory('images/tmp/' . $temporaryImage->folder);
                $temporaryImage->delete();
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $product = Product::create($request->only(['name', 'description', 'price']));
    
         // Attach temporary images to the product
        foreach ($temporaryImages as $temporaryImage) {
            $temporaryFolderPath = 'images/tmp/' . $temporaryImage->folder;
            $files = Storage::disk('public')->files($temporaryFolderPath);

            foreach ($files as $file) {
                $product->addMedia(storage_path('app/public/' . $file))->toMediaCollection('images');
            }

            // Delete the temporary folder from database
            Storage::disk('public')->deleteDirectory($temporaryFolderPath);
            $temporaryImage->delete();
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

    private function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'required|min:1',
        ];
    }

    private function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.max' => 'The product name may not be greater than 255 characters.',
            'description.required' => 'The product description is required.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The product price must be a number.',

            'image.required' => 'At least one product image is required.',
            'image.min' => 'You must upload at least one image.',
            'image.*.required' => 'Each image is required.',
            'image.*.image' => 'Each file must be an image.',
            'image.*.mimes' => 'Images must be of type: jpeg, png, jpg, or gif.',
            'image.*.max' => 'Each image may not exceed 2MB.',
        ];
    }


    public function uploadImages(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $folder = uniqid('image-', true);
            $path = $image->storeAs('images/tmp/'. $folder, $fileName, 'public');

            TemporaryImage::create([
                'folder' => $folder,
                'file' => $fileName
            ]);
            return $folder;
        }

        return response()->json(['error' => 'File upload failed'], 400);
    }

    public function deleteImages(){
        $temporaryImage = TemporaryImage::where('folder', request()->getContent())->first();
        if($temporaryImage){

            Storage::disk('public')->deleteDirectory('images/tmp/' . $temporaryImage->folder);

            $temporaryImage->delete();
        }

        return response()->noContent();
    }
}
