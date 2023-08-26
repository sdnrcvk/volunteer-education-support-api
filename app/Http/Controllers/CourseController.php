<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAll()
    {
         $courses = Course::all();
         return response()->json(['courses' => $courses],200);
    }

    /*Onaylanmış tüm kursları getirir*/
    public function index()
    {
        $courses = Course::where('is_confirm', 1)->get();
        return response()->json(['courses' => $courses], 200);
    }

    /*Onay bekleyen tüm kursları getirir*/
    public function indexAdmin()
    {
        $courses = Course::where('is_confirm', 0)->get();
        return response()->json(['courses' => $courses], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                Rule::unique('courses')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ]
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $course = new Course([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id'),
            'category_id'=>$request->input('category_id'),
            'image_path'=>$request->input('image_path'),
            'is_confirm'=>$request->input('is_confirm')
        ]);

        $course->save();
        
        return response()->json(['message' => 'Ders eklendi.', 'course' => $course],201);
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

    /*Kullanıcının eklediği tüm kursları getirir*/
    public function getCoursesByUser($user_id)
    {
        $courses = Course::where('user_id', $user_id)->get();
        return response()->json(['courses' => $courses],200);
    }

    /*Kullanıcının eklediği onaylanmış kursları getirir*/
    public function getConfirmedCoursesByUser($user_id)
    {
        $courses = Course::where('user_id', $user_id)
                        ->where('is_confirm', 1)
                        ->get();
        return response()->json(['courses' => $courses], 200);
    }

    /*Kullanıcının eklediği henüz onaylanmamış kursları getirir*/
    public function getUnconfirmedCoursesByUser($user_id)
    {
        $courses = Course::where('user_id', $user_id)
                        ->where('is_confirm', 0)
                        ->get();
        return response()->json(['courses' => $courses], 200);
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
        //$course->is_confirm = $request->input('is_confirm');
        $course->save();
    
        return response()->json($course);
    }

    /*Onaylanmamış kursları onaylamak için güncelleme işlemi yapar.*/
    
    public function confirmCourse($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['error' => 'Kurs bulunamadı.'], 404);
        }

        $course->is_confirm = 1;
        $course->save();

        return response()->json(['message' => 'Kurs onaylandı.', 'course' => $course]);
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
