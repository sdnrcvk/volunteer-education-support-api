<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'errors' => ['Kullanıcı adı veya şifre yanlış']
                ], 404);
            }

             $token = $user->createToken('my-app-token')->plainTextToken;

             $userWithDetails = User::with('detail','detail.city', 'detail.district')->find($user->id);

            $response = [
                'user' => $userWithDetails,
                'token' => $token
            ];

             return response($response, 201);
    }

    public function index()
    {
        $users = User::with('detail')->get();
        return response()->json(['users' => $users],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'birthdate' => 'required|date',
            'phone_number' => 'required|unique:user_details,phone_number',
            'gender' => 'required',
            'city_id' => 'required|integer',
            'district_id' => 'required|integer',
        ], [
            'email.unique' => 'Bu e-posta adresi zaten kayıtlı.',
            'phone_number.unique' => 'Bu telefon numarası zaten kayıtlı.',
        ]);

        if ($validator->fails()) {
            // Doğrulama hatalarını ele al
            $errors = $validator->errors();
            // Hataları kullanıcıya göstermek için geri dönüş yapabilirsiniz.
            return response()->json(['errors' => $errors], 422);
        }

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();

        $userDetail = new UserDetail([
            'portfolio_url' => $request->input('portfolio_url'),
            'instagram_url' => $request->input('instagram_url'),
            'linkedin_url' => $request->input('linkedin_url'),
            'user_about' => $request->input('user_about'),
            'task_definition'=> $request->input('task_definition'),
            'birthdate' => $request->input('birthdate'),
            'phone_number' => $request->input('phone_number'),
            'gender' => $request->input('gender'),
            'city_id' => $request->input('city_id'),
            'district_id' => $request->input('district_id'),
            'image_path'=> $request->input('image_path'),
            'user_type'=> $request->input('user_type'),
        ]);

        $user->detail()->save($userDetail);

        return response()->json(['message'=>'Kullanıcı kayıt edildi.', $user, $user->detail],201);
    }

    public function show($id)
    {
        $user = User::with('detail')->find($id);
        if(!$user) {
            return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
        }

        return response()->json(['user' => $user],200);
    }



    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'password' => 'nullable|min:8',
            'birthdate' => 'required|date',
            'phone_number' => 'required|unique:user_details,phone_number,'.$id.',user_id',
            'gender' => 'required',
            'city_id' => 'required|integer',
            'district_id' => 'required|integer',
        ], [
            'email.unique' => 'Bu e-posta adresi zaten kayıtlı.',
            'phone_number.unique' => 'Bu telefon numarası zaten kayıtlı.',
        ]);
    
        if ($validator->fails()) {
            // Doğrulama hatalarını ele al
            $errors = $validator->errors();
            // Hataları kullanıcıya göstermek için geri dönüş yapabilirsiniz.
            return response()->json(['errors' => $errors], 422);
        }
    
    
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
    
        $user->save();
    
        $userDetail = $user->detail;
    
        $userDetail->portfolio_url = $request->input('portfolio_url');
        $userDetail->instagram_url = $request->input('instagram_url');
        $userDetail->linkedin_url = $request->input('linkedin_url');
        $userDetail->user_about = $request->input('user_about');
        $userDetail->task_definition = $request->input('task_definition');
        $userDetail->birthdate = $request->input('birthdate');
        $userDetail->phone_number = $request->input('phone_number');
        $userDetail->gender = $request->input('gender');
        $userDetail->city_id = $request->input('city_id');
        $userDetail->district_id = $request->input('district_id');
        $userDetail->image_path = $request->input('image_path');
        $userDetail->user_type = $request->input('user_type');
    
        $userDetail->save();
    
        // Kullanıcı ve detaylarını içeren JSON yanıtı döndür
        return response()->json([$user]);
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        $userDetail = UserDetail::where('user_id', $id)->firstOrFail();
        $userDetail->delete();
        $user->delete();

        return response()->json(['message' => 'Kullanıcı silindi']);
    }

}
