<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
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
    public function index( Request $request )
    {
        $categories = Category::leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id')
            ->select(['categories.*', 'parent.name as parent_name'])
            ->filter($request->query())->paginate(5);
            // dd($categories);
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
        $request->validate(Category::rules());
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
        if (!$category) {
           return Redirect::route('dashboard.categories.index')->with('info', 'Category not found');
       }   
        $categories = Category::where('id', '<>', $id)->where(function ($query) use ($id) {
            $query->whereNull('parent_id')->orWhere('parent_id', '<>', $id);
        })->get();

        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        // $request->validate(Category::rules($id));

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
        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }
        return Redirect::route('dashboard.categories.index')->with('success', 'Category deleted');
    }

    /**
     * Display a listing of the trashed resource.
     */
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(3);
        return view('dashboard.categories.trash', compact('categories'));
    }
    /**
     * Restore the specified resource from trash.
     */
    public function restore(string $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if ($category->trashed()) {
            $category->restore();
            return Redirect::route('dashboard.categories.index')->with('success', 'Category restored');
        }
        return Redirect::route('dashboard.categories.index')->with('info', 'Category is not in trash');
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete(string $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if ($category->trashed()) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->forceDelete();
            return Redirect::route('dashboard.categories.index')->with('success', 'Category permanently deleted');
        }
        return Redirect::route('dashboard.categories.index')->with('info', 'Category is not in trash');
    }
}
