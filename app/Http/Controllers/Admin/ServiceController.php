<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('admin.services.index', [
            'i' => 1,
            'data' => Service::orderBy('id', 'desc')->paginate(10),
            'active' => Service::where('status', true)->count(),
            'disabled' => Service::where('status', false)->count(),
            'total' => Service::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(ServiceRequest $request)
    {
        $attributes = $request->validated();
        $service = Service::create($attributes);
        if ($request->has('photo') && $request->hasFile('photo')) {
            $service->createMedia();
        }
        session()->flash('success', trans('success_create'));
        return redirect()->route('services.edit', $service);
    }

    /**
     * Display the specified resource.
     *
     * @param Service $services
     * @return Application|Factory|Response|View
     */
    public function show(Service $services)
    {
        return view('admin.services.show', [
            'category' => $services
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Application|Factory|Response|View
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', [
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceRequest $request
     * @param Service $service
     * @return RedirectResponse
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $attributes = $request->only(['author']);
        if ($request->has('photo') && $request->hasFile('photo')) {
            $service->clearMediaCollection('service')
                ->createMedia();
        }
        $data = collect($request->only(locales()))->filter(function ($locale) {
            if (!is_null($locale['title']) && !is_null($locale['body'])) {
                return $locale;
            }
            return null;
        });
        $service->update(array_merge($attributes, $data->toArray()));
        session()->flash('success', trans('success_update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $services
     * @return Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        session()->flash('success', trans('success_delete'));
        return redirect()->back();
    }


    /**
     * active
     *
     * @param mixed $category
     * @return RedirectResponse
     */

    public function status(Service $service)
    {
        $service->update(['status' => !$service->status]);
        session()->flash('success', $service->status == 1 ? trans('success_active') : trans('success_un_active'));
        return redirect()->back();
    }

}
