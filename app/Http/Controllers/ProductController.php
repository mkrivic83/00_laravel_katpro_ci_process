<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id')->paginate(5);
        return view('products.index',compact('products'));
    }

    public function indexDb(){
        $products=DB::table('products')
            ->join('categories','products.category_id','=','categories.id')
            ->select(
                'products.id',
                'products.naziv',
                'categories.naziv as kategorija',
                'products.cijena',
                'products.kolicina',
                'products.created_at',
                'products.updated_at'
            )
            ->orderBy('products.id')
            ->get();

            return view('products.indexDb',compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('admin-access');
        $categories = Category::orderBy('naziv')->get();
        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('admin-access');

        $validated = $request->validate([
            'category_id'=>[
                'required',
                'exists:categories,id',
            ],
            'naziv'=>[
                'required',
                'string',
                'max:255',
            ],
            'opis'=>[
                'nullable',
                'string',
            ],
            'cijena'=>[
                'required',
                'numeric',
                'min:0',
            ],
            'kolicina'=>[
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $validated['izvor']='custom';

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success','Proizvod je uspješno dodan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        Gate::authorize('admin-access');
        $categories = Category::orderBy('naziv')->get();
        return view('products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        Gate::authorize('admin-access');

        $validated = $request->validate([
            'category_id'=>[
                'required',
                'exists:categories,id',
            ],
            'naziv'=>[
                'required',
                'string',
                'max:255',
            ],
            'opis'=>[
                'nullable',
                'string',
            ],
            'cijena'=>[
                'required',
                'numeric',
                'min:0',
            ],
            'kolicina'=>[
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success','Proizvod je uspješno ažuriran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Gate::authorize('admin-access');
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success','Proizvod je uspješno izbrisan');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $products=Product::with('category')
            ->when($search,function ($query,$search){
                $query->where('naziv','like','%'.$search.'%')
                ->orWhereHas('category',function ($categoryQuery) use ($search){
                    $categoryQuery->where('naziv','like','%'.$search.'%');
                });
            })
            ->orderBy('id')
            ->paginate(5)
            ->withQueryString();

        return view('products.search',compact('products','search'));
    }
}
