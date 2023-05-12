<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $course = new Course([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id'),
            'category_id'=>$request->input('category_id'),
            'image_path'=>$request->input('image_path'),
            'is_confirm'=>$request->input('is_confirm')
        ]);

        $course->save();
        
        return response()->json($course);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course = Course::find($id);
    
        if(!$course) {
            return response()->json(['error' => 'Kurs bulunamadı.'], 404);
        }
    
        return response()->json($course);
    }
    

    public function getCoursesByUser($user_id)
    {
        $courses = Course::where('user_id', $user_id)->get();
        return response()->json($courses);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
    
        if(!$course) {
            return response()->json(['error' => 'Kurs bulunamadı.'], 404);
        }
    
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->category_id = $request->input('category_id');
        $course->image_path = $request->input('image_path');
        $course->is_confirm = $request->input('is_confirm');
        $course->save();
    
        return response()->json($course);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::find($id);
    
        if(!$course) {
            return response()->json(['error' => 'Kurs bulunamadı.'], 404);
        }
    
        $course->delete();
    
        return response()->json(['message' => 'Kurs başarıyla silindi.']);
    }
    
}
