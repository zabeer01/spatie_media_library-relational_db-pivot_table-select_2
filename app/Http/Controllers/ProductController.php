<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
    public function store(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
        ]);

        // Create a new product instance
        $product = new Product();
       
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->save();

        if ($request->input('category')) {

            $product->categories()->sync($request->input('category'));
        }
        $productId = $product->id ; 

        foreach ($request->input('document', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('document');
            $productMedia = new ProductMedia();
           
            $productMedia->product_id = $productId;
            $productMedia->file_name = $file;
            $productMedia->save();
        }


        // Redirect the user back to the index page
        return redirect()->route('products.index');
    }
    public function uploadFile(Request $request)
    {


        $image = $request->file('file');
        $imageName = time() . $image->getClientOriginalName() . '.' . $image->extension();
        $image->move(public_path('file'), $imageName);

        return response()->jason(['success' => $imageName]);
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function deleteMedia(Request $request)
    {
        dd($request);
        // Retrieve the file name from the request
        $fileName = $request->input('file_name');
        try {
            Storage::delete('tmp/uploads/' . $fileName);
            return response()->json(['message' => 'File deleted successfully']);
        } catch (\Exception $e) {
            // Log the error or handle it in some other way
            return response()->json(['error' => 'Failed to delete file'], 500);
        }
    }
}
