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

        $homeBudgets = HomeBudget::with('category')
        ->orderBy('date', 'desc')
        ->paginate(5);
        return view('homebudget.index', compact('homeBudgets', 'categories'));
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
    public function edit($id)
    {   
        $homeBudget = HomeBudget::find($id);
        $categories = Category::all();
        return view('homebudget.edit', compact('homeBudget', 'categories'));
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeBudget $homeBudget)
    {
        // バリデーションルール
        $request->validate([
            'date' => 'required|date',
            'category' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
    
        // データの更新
        $homeBudget->update([
            'date' => $request->input('date'),
            'category_id' => $request->input('category'),
            'price' => $request->input('price'),
        ]);
    
        // 更新後のリダイレクト
        return redirect()->route('index', ['page' => $request->input('page')])
        ->with('success', '支出を更新しました。');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeBudget $homeBudget)
    {
        $homeBudget->delete();
        $page = request()->input('page');
       
        return redirect()->route('index', ['page' => $page])
        ->with('success',  '収支を削除しました。');
    }
}
