<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $request->merge([
                'image' => $request->file('image')->store('categories', 'public'),
            ]);
        }

        $request->merge([
            'slug' => Str::slug($request->input('name')),
        ]);
        $category = Category::create($request->post());
        return Redirect::route('dashboard.categories.index')->with('success', 'category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '<>', $id)->where(function ($query) use ($id) {
            $query->whereNull('parent_id')->orWhere('parent_id', '<>', $id);
        })->get();

        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge([
            'slug' => Str::slug($request->input('name')),
        ]);
        
        $category = Category::findOrFail($id);
        $old_image = $category->image;

        if ($request->hasFile('image')) {
            $request->merge([
                'image' => $request->file('image')->store('categories', 'public'),
            ]);
        }
        $category->update($request->post());

        if ($request->hasFile('image') && $old_image) {
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('dashboard.categories.index')->with('success', 'category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return Redirect::route('dashboard.categories.index')->with('success', 'Category deleted');
    }
}
