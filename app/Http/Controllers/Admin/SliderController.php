<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use App\Models\Language;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */

    public function index()
    {
        return view('admin.sliders.index', [
            'i' => 1,
            'data' => Slider::orderBy('id', 'desc')->paginate(10),
            'active' => Slider::where('status', true)->count(),
            'disabled' => Slider::where('status', false)->count(),
            'total' => Slider::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */

    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SliderRequest $request
     * @return RedirectResponse
     */

    public function store(SliderRequest $request)
    {
        $attributes = $request->validated();
        $slider = Slider::create($attributes);
        if ($request->has('photo') && $request->hasFile('photo')) {
            $slider->createMedia();
        }
        session()->flash('success', trans('success_create'));
        return redirect()->route('sliders.edit', $slider);
    }

    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     * @return Application|Factory|Response|View
     */

    public function show(Slider $slider)
    {
        return view('admin.sliders.show', [
            'slider' => $slider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     * @return Application|Factory|Response|View
     */

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', [
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderRequest $request
     * @param Slider $slider
     * @return RedirectResponse
     */

    public function update(SliderRequest $request, Slider $slider)
    {
        $attributes = $request->only(['author']);
        if ($request->has('photo') && $request->hasFile('photo')) {
            $slider->clearMediaCollection('slider')
                ->createMedia();
        }
        $data = collect($request->only(locales()))->filter(function ($locale) {
            if (!is_null($locale['body'])) {
                return $locale;
            }
            return null;
        });
        $slider->update(array_merge($attributes, $data->toArray()));
        session()->flash('success', trans('success_update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return RedirectResponse
     */

    public function destroy(Slider $slider)
    {
        $slider->delete();
        session()->flash('success', trans('messages.success_delete'));
        return redirect()->back();
    }

    /**
     * active
     * @param Slider $slider
     * @return RedirectResponse
     */
    public function status(Slider $slider)
    {
        $slider->update(['status' => !$slider->status]);
        session()->flash('success', $slider->status == 1 ? trans('success_active') : trans('success_un_active'));
        return redirect()->back();
    }
}
