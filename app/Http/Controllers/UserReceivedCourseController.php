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
    public function getReceivedCoursesByUserId($userId)
    {
        $receivedCourses = UserReceivedCourse::where('user_id', $userId)
        ->with('course') // Kurs detaylarını ilişkili tablodan getir
        ->get();

        if ($receivedCourses->isEmpty()) {
            return response()->json(['message' => 'Kurs bulunamadı'], 404);
        }

        // Kullanıcının aldığı kursları ve detaylarını döndür
        return response()->json(['courses' => $receivedCourses],200);
    }

    public function store(Request $request)
    {

        $userId = $request->input('user_id');
        $courseId = $request->input('course_id');

        // Check if the user has already received the course
        $existingEntry = UserReceivedCourse::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if ($existingEntry) {
            return response()->json(['message' => 'Bu kullanıcı zaten bu kursu almış.'], 422);
        }

        $userReceivedCourse = new UserReceivedCourse([
            'user_id' => $userId,
            'course_id' => $courseId
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
