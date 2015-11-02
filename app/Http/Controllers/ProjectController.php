<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gm\Repositories\ProjectRepository;


class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * Initialize variables for the controller.
     *
     * @param ProjectRepository $repository
     */
    function __construct(ProjectRepository $repository)
    {

        $this->repository = $repository;
    }
    /**
     * Display a listing of the projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->repository->allProjectsForCurrentUser();

        return view('gm.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gm.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        $this->repository->createProject($request);

        return redirect('/all/projects');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function edit($projectId)
    {
        $project = $this->repository->findProjectWithId($projectId);

        return view('gm.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProjectRequest $request
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $projectId)
    {
        $project = $this->repository->findProjectWithId($projectId);
        $this->repository->updateProject($project, $request);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId)
    {
        $project = $this->repository->findProjectWithId($projectId);

        $this->repository->deleteProject($project);

        return redirect()->back();
    }
}
