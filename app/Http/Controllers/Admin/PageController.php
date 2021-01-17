<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View|Application|Factory|View
     */
    public function index()
    {
        return view('admin.pages.index', [
            'i' => 1,
            'data' => Page::orderBy('id', 'desc')->paginate(10),
            'active' => Page::where('status', true)->count(),
            'disabled' => Page::where('status', false)->count(),
            'total' => Page::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(PageRequest $request)
    {
        $attributes = $request->validated();
        $page = Page::create($attributes);
        session()->flash('success', trans('success_create'));
        return redirect()->route('pages.edit', $page);
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return Application|Factory|Response|View
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', [
            'page' => $page
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return Application|Factory|Response|View
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', [
            'page' => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param Page $page
     * @return RedirectResponse
     */
    public function update(PageRequest $request, Page $page)
    {
        $attributes = $request->only(['author']);
        $data = collect($request->only(locales()))->filter(function ($locale) {
            if (!is_null($locale['title']) && !is_null($locale['body'])) {
                return $locale;
            }
            return null;
        });

        $page->update(array_merge($attributes, $data->toArray()));
        session()->flash('success', trans('success_update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();
        session()->flash('success', trans('success_delete'));
        return redirect()->back();
    }

    /**
     * active
     *
     * @param Page $page
     * @return RedirectResponse
     */

    public function status(Page $page)
    {
        $page->update(['status' => !$page->status]);
        session()->flash('success', $page->status == 1 ? trans('success_active') : trans('success_un_active'));
        return redirect()->back();
    }
}
