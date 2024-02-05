<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view ('categories.index',compact('categories'));
    }
    public function create()
    {
        return view ('categories.create');
    }
    public function store(Request $request)
    {
      
      
        // Validate the incoming request data
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
          
        ]);

        // Create a new product instance
        $category = new Category();
        $category->category_name = $request->category_name;
     
        $category->save();

     


        // Redirect the user back to the index page
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
