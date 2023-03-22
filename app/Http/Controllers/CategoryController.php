<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    function getAll(){
        return Category::all();
    }

    function getById($id){
        return Category::find($id);
    }

    function add(Request $request){
        $category = new Category;
        $category->category_name = $request->category_name;
        $result=$category->save();

        if($result){
            return ["result"=>"Kategori Eklendi"];
        }else{
            return ["result"=>"Hata Oluştu"];
        }
        
    }

    function update(Request $request, $id){
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $result=$category->save();

        if($result){
            return ["result"=>"Kategori güncellendi"];
        }else{
            return ["result"=>"Hata Oluştu"];
        }
    }

    function search($name){
        return Category::where("category_name","like","%".$name."%")->get();
    }

    function delete($id){
        $category = Category::find($id);
        $result=$category->delete();

        if($result){
            return ["result"=>"Kategori silindi"];
        }else{
            return ["result"=>"Hata Oluştu"];
        }
    }
}
