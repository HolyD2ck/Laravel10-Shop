<?php

namespace App\Http\Controllers;

use App\Models\Taskmasters;
use Illuminate\Http\Request;

class TaskmastersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskmasters = Taskmasters::all();
        return view('taskmasters.index', compact('taskmasters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taskmasters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try 
        {
            $validatedData = $request->validate([
                'Название' =>'required|max:255',
                'Дата_Основания' =>'required|date_format:Y-m-d',
                'Директор' =>'required|max:255',
                'Страна' =>'required|max:255',
                'Гост' =>'required|max:255',
                'Почта' =>'required|max:255',
            ]);
            $filename="";

            if($request->hasFile('Фото'))
            {
                $file = $request->file('Фото');
                $extension = $file->getClientOriginalExtension();
                $filename = '/img/taskmasters/'.time().'.'.$extension;
                $file->move(public_path('img/taskmasters/'), $filename);
            }

            $taskmasters = new Taskmasters();
            $taskmasters->Название = $request->Название;
            $taskmasters->Дата_Основания = $request->Дата_Основания;
            $taskmasters->Директор = $request->Директор;
            $taskmasters->Страна = $request->Страна;
            $taskmasters->Гост = $request->Гост;
            $taskmasters->Почта = $request->Почта;
            $taskmasters->Фото = $filename;
            $taskmasters->save();

            return redirect()->route('taskmasters.index')->with('success', 'Данные успешно сохранены');
        }
        catch(\Exception $e) {echo('Ошибка при сохранении данных: '. $e->getMessage());}
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Taskmasters $taskmasters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $taskmasters = Taskmasters::find($id);
        return view('taskmasters.edit', compact('taskmasters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try 
        {
            $validatedData = $request->validate([
                'Название' =>'required|max:255',
                'Дата_Основания' =>'required|date_format:Y-m-d',
                'Директор' =>'required|max:255',
                'Страна' =>'required|max:255',
                'Гост' =>'required|max:255',
                'Почта' =>'required|max:255',
            ]);

            $taskmasters = Taskmasters::find($id);
            $file_name= $taskmasters->Фото;

            if($request->hasFile('Фото')) {
                $file_name = '/img/taskmasters/'.time().'.'.$request->Фото->getClientOriginalExtension();
                $request->Фото->move(public_path('img/taskmasters'),$file_name);
            }

            $taskmasters->Название = $request->Название;
            $taskmasters->Дата_Основания = $request->Дата_Основания;
            $taskmasters->Директор = $request->Директор;
            $taskmasters->Страна = $request->Страна;
            $taskmasters->Гост = $request->Гост;
            $taskmasters->Почта = $request->Почта;
            $taskmasters->Фото = $file_name;
            $taskmasters->save();

            return redirect()->route('taskmasters.index')->with('success', 'Данные успешно изменены');
        }
        catch(\Exception $e) {echo('Ошибка при изменении данных: '. $e->getMessage());}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Taskmasters $taskmasters,$id)
    {
        $taskmasters = Taskmasters::find($id);
        
        if (!$taskmasters) {
            return redirect()->route('taskmasters.index')->with('error', 'Данные не найдены');
        }

        $image = public_path().$taskmasters->Фото;

        try {
            $taskmasters->delete();
            @unlink($image);
        }
        catch(\Exception $e) {return redirect()->route('taskmasters.index')->with('error', 'Ошибка при удалении' );}

        return redirect()->route('taskmasters.index')->with('success', 'Данные уcпешно удалены');
    }
}
