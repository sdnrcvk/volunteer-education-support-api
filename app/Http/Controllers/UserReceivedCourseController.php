<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\UserReceivedCourse;
use Illuminate\Http\Request;

class UserReceivedCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getReceivedCoursByUserId($userId)
    {
        $receivedCourse = UserReceivedCourse::where('user_id', $userId)
        ->with('course') // Kurs detaylarını ilişkili tablodan getir
        ->get();

        if ($receivedCourse->isEmpty()) {
            return response()->json(['message' => 'Kurs bulunamadı'], 404);
        }

        // Kullanıcının aldığı kursları ve detaylarını döndür
        return response()->json($receivedCourse, 200);
    }

    public function store(Request $request)
    {
        $userReceivedCourse = new UserReceivedCourse([
            'user_id' => $request->input('user_id'),
            'course_id'=>$request->input('course_id')
        ]);

        $userReceivedCourse->save();
        
        return response()->json(['message' => 'Kurs alındı.', 'userReceivedCourse' => $userReceivedCourse],201);

    }

    public function destroy($id)
    {

        $userReceivedCourse = UserReceivedCourse::find($id);

        if (!$userReceivedCourse) {
            return response()->json(['message' => 'Kurs bulunamadı'], 404);
        }

        $userReceivedCourse->delete();

        return response()->json(['message' => 'Alınan kurs başarıyla silindi'], 200);
    }
}
