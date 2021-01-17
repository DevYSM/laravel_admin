<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View|Application|Factory|View
     */
    public function index()
    {
        return view('admin.projects.index', [
            'i' => 1,
            'data' => Project::orderBy('id', 'desc')->paginate(10),
            'active' => Project::where('status', true)->count(),
            'disabled' => Project::where('status', false)->count(),
            'total' => Project::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(ProjectRequest $request)
    {
        $attributes = $request->validated();
        $project = Project::create($attributes);
        if ($request->has('photo') && $request->hasFile('photo')) {
            $project->createMedia();
        }
        session()->flash('success', trans('success_create'));
        return redirect()->route('projects.edit', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return Application|Factory|Response|View
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return Application|Factory|Response|View
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return RedirectResponse
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $attributes = $request->only(['author']);
        if ($request->has('photo') && $request->hasFile('photo')) {
            $project->clearMediaCollection('project')
                ->createMedia();
        }
        $data = collect($request->only(locales()))->filter(function ($locale) {
            if (!is_null($locale['title']) && !is_null($locale['body'])) {
                return $locale;
            }
            return null;
        });
        $project->update(array_merge($attributes, $data->toArray()));
        session()->flash('success', trans('success_update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return RedirectResponse
     */
    public function destroy(Project $project)
    {
        $project->delete();
        session()->flash('success', trans('success_delete'));
        return redirect()->back();
    }


    /**
     * active
     *
     * @param mixed $category
     * @return RedirectResponse
     */

    public function status(Project $project)
    {
        $project->update(['status' => !$project->status]);
        session()->flash('success', $project->status == 1 ? trans('success_active') : trans('success_un_active'));
        return redirect()->back();
    }
}
