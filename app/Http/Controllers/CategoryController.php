<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if(!$category) {
            return response()->json(['message' => 'Kategori bulunamadı.'], 404);
        }
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|unique:categories'
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();

        return response()->json(['message' => 'Kategori eklendi.', 'category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if(!$category) {
            return response()->json(['message' => 'Kategori bulunamadı.'], 404);
        }

        $this->validate($request, [
            'category_name' => 'required|unique:categories,category_name,'.$id
        ]);

        $category->category_name = $request->category_name;
        $category->save();

        return response()->json(['message' => 'Kategori güncellendi.', 'category' => $category]);
    }

    public function search(Request $request)
    {
        $categories = Category::where("category_name", "like", "%" . $request->name . "%")->get();
        return response()->json($categories);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category) {
            return response()->json(['message' => 'Kategori bulunamadı.'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Kategori silindi.']);
        
    }
}
