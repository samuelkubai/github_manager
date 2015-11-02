<?php

namespace App\Http\Controllers;

use App\Gm\Repositories\ProjectRepository;
use App\Gm\Repositories\TaskRepository;
use App\Http\Requests\CreateTaskRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    private $repository;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * Initialize the controller variables.
     *
     * @param TaskRepository $repository
     * @param ProjectRepository $projectRepository
     */
    function __construct(TaskRepository $repository, ProjectRepository $projectRepository)
    {

        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
    }
    /**
     * Display a listing of the projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->repository->getAllTasksForCurrentUser();

        return view('gm.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = $this->projectRepository->allProjectsForCurrentUser();

        return view('gm.tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $this->repository->createTask($request);

        return redirect('/all/tasks');
    }
}
