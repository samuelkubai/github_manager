<?php namespace App\Gm\Repositories;


use App\Task;
use App\Http\Requests\CreateTaskRequest;
use Github\Client;


class TaskRepository
{
    /**
     * Initialize the controller class.
     * @param Client $github
     */
    public function __construct(Client $github)
    {
        $this->github = $github;
    }
    /**
     * Create new task.
     *
     * @param CreateTaskRequest $request
     * @return static
     */
    public function createTask(CreateTaskRequest $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'user_id' => \Auth::user()->id,
            'project_id' => $request->project,
        ]);
        $this->createAGithubIssueForTask($task);
        return $task;
    }

    /**
     * Gets all the tasks for the authenticated user.
     *
     * @return mixed
     */
    public function getAllTasksForCurrentUser()
    {
        return \Auth::user()->tasks;
    }

    /**
     * Creates an issue for the task created.
     *
     * @param $task
     */
    private function createAGithubIssueForTask($task)
    {
        //Add task as issue to github.
        $this->github->authenticate(env('GITHUB_TOKEN'), null, Client::AUTH_HTTP_TOKEN);
        $this->github->api('issue')->create(\Auth::user()->username, $task->project->slug, array('title' => $task->name, 'body' => ''));
    }

}