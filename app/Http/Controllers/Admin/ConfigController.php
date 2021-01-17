<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigRequest;
use App\Models\config;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View|Application|Factory|View
     */
    public function index()
    {
        return view('admin.configs.index', [
            'i' => 1,
            'data' => Config::orderBy('id', 'desc')->paginate(10),
            'active' => Config::where('status', true)->count(),
            'disabled' => Config::where('status', false)->count(),
            'total' => Config::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.configs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(ConfigRequest $request)
    {
        $attributes = $request->validated();
        $config = Config::create($attributes);
        session()->flash('success', trans('success_create'));
        return redirect()->route('configs.edit', $config);
    }

    /**
     * Display the specified resource.
     *
     * @param Config $config
     * @return Application|Factory|Response|View
     */
    public function show(Config $config)
    {
        return view('admin.configs.show', [
            'config' => $config
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Config $config
     * @return Application|Factory|Response|View
     */
    public function edit(Config $config)
    {
        return view('admin.configs.edit', [
            'config' => $config
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConfigRequest $request
     * @param Config $config
     * @return RedirectResponse
     */
    public function update(ConfigRequest $request, Config $config)
    {
        $attributes = $request->only(['author']);
        $data = collect($request->only(locales()))->filter(function ($locale) {
            if (!is_null($locale['config_name']) && !is_null($locale['config_value'])) {
                return $locale;
            }
            return null;
        });
        $config->update(array_merge($attributes, $data->toArray()));
        session()->flash('success', trans('success_update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Config $config
     * @return RedirectResponse
     */
    public function destroy(Config $config)
    {
        $config->delete();
        session()->flash('success', trans('success_delete'));
        return redirect()->back();
    }

    /**
     * active
     *
     * @param mixed $category
     * @return RedirectResponse
     */
    public function status(Config $config)
    {
        $config->update(['status' => !$config->status]);
        session()->flash('success', $config->status == 1 ? trans('success_active') : trans('success_un_active'));
        return redirect()->back();
    }

}
