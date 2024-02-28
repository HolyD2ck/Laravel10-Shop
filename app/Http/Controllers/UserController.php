<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("users.index",['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        try 
        {
            $validatedData = $request->validate
            ([
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'Телефон' => 'required|max:255',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $file_name = ""; 

            if($request->hasFile('Аватар')) {
                $file_name = '/img/users/'.time().'.'.$request->Аватар->getClientOriginalExtension();
                $request->Аватар->move(public_path('img/users'),$file_name);
            } else {
                echo "Фото не загружено";
            }
            $user = new User;
            $user->name= $request->name;
            $user->email = $request->email;
            $user->Телефон = $request->Телефон;
            $user->Аватар = $file_name;
            $user->password = Hash::make($request->password);
            $user->role=$request->role;
            $user->save();
        
            return redirect('/users');
        }   
        catch (\Exception $e) {echo('Ошибка при создании пользователя: ' . $e->getMessage());}
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $user = User::find($id);
      return view("users.edit",['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' =>'required|max:255',
            'email' =>'required|max:255',
            'Телефон' =>'required|max:255',
        ]);
    
        $file_name = $user->Аватар; 
    
        if($request->hasFile('Аватар')) {
            $file_name = '/img/users/'.time().'.'.$request->Аватар->getClientOriginalExtension();
            $request->Аватар->move(public_path('img/users'),$file_name);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->Телефон = $request->Телефон;
        $user->Аватар = $file_name;
        $user->role=$request->role;
        $user->save();
        return redirect('/users');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return redirect('/users/index')->with('error', 'Соискатель не найден');
        }
    
        $image_path = public_path();
        $image = $image_path . $user->Фото;
        
    
        try {
            $user->delete();
            if($image!='/img/user.jpg'){
            @unlink($image);
            }
        } catch (\Exception $e) {
            return redirect('/users')->with('error', 'Ошибка при удалении: ' . $e->getMessage());
        }
    
        return redirect('/users')->with('success', 'Соискатель успешно удален');
    }
}
