<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::with('taskmaster')->get();
        return view('products.index', ['products' => $products]);        
    }
    public function main()
    {
        $products = Products::with('taskmaster')->get();
        return view('main', ['products' => $products]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'Категория' =>'required|max:255',
                'Тип' =>'required|max:255',
                'Название' =>'required|max:255',
                'Цена' =>'required',
                'Описание' =>'required',
                'taskmaster_id' =>'required',
            ]);

            $file_name = "";
            if($request->hasFile('Фото')) {
                $file_name = '/img/products/'.time().'.'.$request->Фото->getClientOriginalExtension();
                $request->Фото->move(public_path('img/products'),$file_name);
            }
            $product = new Products();
            $product->Категория = $request->Категория;
            $product->Тип = $request->Тип;
            $product->Название = $request->Название;
            $product->Цена = $request->Цена;
            $product->Описание = $request->Описание;
            $product->Фото = $file_name;
            $product->taskmaster_id = $request->taskmaster_id;
            $product->save();

            return redirect()->route('products.index');
        }
        catch(\Exception $e) {echo('Ошибка при добавлении данных: '. $e->getMessage());}
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products = Products::find($id);
        return view('products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            //dd($request->all());

            $validatedData = $request->validate([
                'Категория' =>'required|max:255',
                'Тип' =>'required|max:255',
                'Название' =>'required|max:255',
                'Цена' =>'required',
                'Описание' =>'required',
                'taskmaster_id' =>'required',
            ]);

            $product = Products::find($id);
            
            $file_name = $product->Фото;

            if($request->hasFile('Фото')) {
                $file_name = '/img/products/'.time().'.'.$request->Фото->getClientOriginalExtension();
                $request->Фото->move(public_path('img/products'),$file_name);
            }
        
            $product->Категория = $request->Категория;
            $product->Тип = $request->Тип;
            $product->Название = $request->Название;
            $product->Цена = $request->Цена;
            $product->Описание = $request->Описание;
            $product->Фото = $file_name;
            $product->taskmaster_id = $request->taskmaster_id;
            $product->save();

            return redirect()->route('products.index');
        }
        catch(\Exception $e) {echo('Ошибка при изменении данных: '. $e->getMessage());}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $products = Products::find($id);
            $products->delete();
            if (file_exists(public_path().$products->Фото)) {
                @unlink(public_path().$products->Фото);
            }
            
            return redirect()->route('products.index');
         
        }
        catch(\Exception $e) {echo('Ошибка при удалении данных: '. $e->getMessage());}
    }
}
