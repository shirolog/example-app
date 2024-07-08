<?php

namespace App\Http\Controllers;

use App\Models\HomeBudget;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $categories = Category::all();
         $homeBudget = HomeBudget::with('category')->get();

        return view('homebudget.index', compact('categories', 'homeBudget'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'date' => 'required|date',
            'category' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $homeBudget = new HomeBudget;

        $homeBudget-> date = $request->input('date');
        $homeBudget-> category_id = $request->input('category');
        $homeBudget-> price = $request->input('price');
        $homeBudget->save();
        
        if(!$homeBudget->save()){
            return redirect()->route('index')
            ->with('error', '支出の登録に失敗しました。');           
        }else{
            return redirect()->route('index')
            ->with('success', '支出を登録しました。');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeBudget $homeBudget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeBudget $homeBudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeBudget $homeBudget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeBudget $homeBudget)
    {
        //
    }
}
