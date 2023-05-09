<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        return response()->json(['data' => $messages],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = Message::create([
            'fullname' => $request->get('fullname'),
            'email'=> $request->get('email'),
            'message'=> $request->get('message')
        ]);

        return response()->json(['message' => 'Mesaj eklendi.','data'=> $message], 201);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        if(!$message) {
            return response()->json(['error' => 'Mesaj bulunamadı.'], 404);
        }

        $message->delete();
        return response()->json(['message' => 'Mesaj silindi.'],200);
    }
}
