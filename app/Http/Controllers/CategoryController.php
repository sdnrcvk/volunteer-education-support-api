<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => [
                'required',
                Rule::unique('categories')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ]
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $category = Category::create([
            'category_name' => $request->get('category_name'),
            'is_confirm'=> $request->get('category_name')
        ]);

        return response()->json(['message' => 'Kategori eklendi.', 'category' => $category],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        if(!$category) {
            return response()->json(['message' => 'Kategori bulunamadı.'], 404);
        }
        return response()->json(['category' => $category],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories,category_name,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $category = Category::find($id);
        if(!$category) {
            return response()->json(['message' => 'Kategori bulunamadı.'], 404);
        }

        $category->category_name = $request->get('category_name');
        $category->save();

        return response()->json(['message' => 'Kategori güncellendi.', 'category' => $category],200);
    }
    
    public function search(Request $request)
    {
        $categories = Category::where("category_name", "like", "%" . $request->name . "%")->get();
        return response()->json($categories);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category) {
            return response()->json(['error' => 'Kategori bulunamadı.'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Kategori silindi.'],200);
    }
}
