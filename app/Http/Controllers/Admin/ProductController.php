<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest ;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View|Application|Factory|View
     */
    public function index()
    {
        return view('admin.products.index', [
            'i' => 1,
            'data' => Product::orderBy('id', 'desc')->paginate(10),
            'active' => Product::where('status', true)->count(),
            'disabled' => Product::where('status', false)->count(),
            'total' => Product::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $attributes = $request->validated();
        $product = Product::create($attributes);
        if ($request->has('photo') && $request->hasFile('photo')) {
            $product->createMedia();
        }
        session()->flash('success', trans('success_create'));
        return redirect()->route('products.edit', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function show(Product $product)
    {
        return view('admin.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $attributes = $request->only(['author']);
        if ($request->has('photo') && $request->hasFile('photo')) {
            $product->clearMediaCollection('product')
                ->createMedia();
        }
        $data = collect($request->only(locales()))->filter(function ($locale) {
            if (!is_null($locale['title']) && !is_null($locale['body'])) {
                return $locale;
            }
            return null;
        });
        $product->update(array_merge($attributes, $data->toArray()));
        session()->flash('success', trans('success_update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('success', trans('success_delete'));
        return redirect()->back();
    }


    /**
     * active
     *
     * @param mixed $category
     * @return RedirectResponse
     */

    public function status(Product $product)
    {
        $product->update(['status' => !$product->status]);
        session()->flash('success', $product->status == 1 ? trans('success_active') : trans('success_un_active'));
        return redirect()->back();
    }
}
