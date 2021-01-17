<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View|Application|Factory|View
     */
    public function index()
    {
        return view('admin.sections.index', [
            'i' => 1,
            'data' => Section::orderBy('id', 'desc')->paginate(10),
            'active' => Section::where('status', true)->count(),
            'disabled' => Section::where('status', false)->count(),
            'total' => Section::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(SectionRequest $request)
    {
        $attributes = $request->validated();
        $section = Section::create($attributes);
        session()->flash('success', trans('success_create'));
        return redirect()->route('sections.edit', $section);
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return Application|Factory|Response|View
     */
    public function show(Section $section)
    {
        return view('admin.sections.show', [
            'section' => $section
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @return Application|Factory|Response|View
     */
    public function edit(Section $section)
    {
        return view('admin.sections.edit', [
            'section' => $section
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SectionRequest $request
     * @param Section $section
     * @return RedirectResponse
     */
    public function update(SectionRequest $request, Section $section)
    {
        $attributes = $request->only(['author']);
        $data = collect($request->only(locales()))->filter(function ($locale) {
            if (!is_null($locale['body'])) {
                return $locale;
            }
            return null;
        });
        $section->update(array_merge($attributes, $data->toArray()));
        session()->flash('success', trans('success_update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        session()->flash('success', trans('success_delete'));
        return redirect()->back();
    }


    /**
     * active
     *
     * @param mixed $category
     * @return RedirectResponse
     */

    public function status(Section $section)
    {
        $section->update(['status' => !$section->status]);
        session()->flash('success', $section->status == 1 ? trans('success_active') : trans('success_un_active'));
        return redirect()->back();
    }

}
