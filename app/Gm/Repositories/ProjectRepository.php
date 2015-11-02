<?php namespace App\Gm\Repositories;

use App\Project;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Github\Client;

class ProjectRepository
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
     * Creates a project.
     *
     * @param CreateProjectRequest $request
     */
    public function createProject(CreateProjectRequest $request)
    {

        $project  = \Auth::user()->projects()->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description
        ]);

        $this->createGithubRepositoryForProject($project);

        return $project;
    }

    /**
     * Update a project.
     *
     * @param Project $project
     * @param UpdateProjectRequest $request
     * @return Project
     */
    public function updateProject(Project $project, UpdateProjectRequest $request)
    {
        $this->updateGithubRepositoryForProject($project, $request);

        $project->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description
        ]);

        return $project;
    }

    /**
     * Delete the project.
     *
     * @param Project $project
     */
    public function deleteProject(Project $project)
    {
       $this->deleteGithubRepositoryForProject($project);

        $project->delete();
    }

    /**
     * Return the projects for the authenticated user.
     *
     * @return mixed'
     */
    public function allProjectsForCurrentUser()
    {
        return \Auth::user()->projects;
    }

    /**
     * Finds a project with the given Id number.
     *
     * @param $project
     */
    public function findProjectWithId($project)
    {
        return Project::find($project);
    }

    /**
     * Create a Github repository for the project.
     *
     * @param $project
     * @return mixed
     */
    private function createGithubRepositoryForProject($project)
    {
        //Create new repo with name as project slug and description as description
        $this->github->authenticate(env('GITHUB_TOKEN'), null, Client::AUTH_HTTP_TOKEN);
        $repo = $this->github->api('repo')->create($project->slug, $project->description, '', true);

        return $repo;
    }

    /**
     * Update the Github Repository for a project.
     *
     * @param $project
     * @param $request
     * @return mixed
     */
    private function updateGithubRepositoryForProject($project, $request)
    {
        //Update the repo appropriately slug update repo name, while description update repo description.
        $this->github->authenticate(env('GITHUB_TOKEN'), null, Client::AUTH_HTTP_TOKEN);
        $repo = $this->github->api('repo')->update(\Auth::user()->username, $project->slug, array('description' => $request->description, 'name' => $request->slug));

        return $repo;
    }

    /**
     * Deletes a github repository of a certain project.
     *
     * @param $project
     */
    private function deleteGithubRepositoryForProject($project)
    {
        //Delete the repo on github.
        $this->github->authenticate(env('GITHUB_TOKEN'), null, Client::AUTH_HTTP_TOKEN);
        $this->github->api('repo')->remove(\Auth::user()->username, $project->slug);
    }
}