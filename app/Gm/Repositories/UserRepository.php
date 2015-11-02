<?php namespace App\Gm\Repositories;


use App\Gm\Mail\UserMailer;
use App\Task;
use App\User;
use App\Project;
use Github\Client;

class UserRepository
{
    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * Initialize the controller class.
     * @param Client $github
     * @param UserMailer $mailer
     */
    public function __construct(Client $github, UserMailer $mailer)
    {
        $this->github = $github;
        $this->mailer = $mailer;
    }

    /**
     * Finds or creates a user by the user's username.
     *
     * @param $githubUser
     * @return User $user
     */
    public function findOrCreateUserByUsername($githubUser)
    {
        $user = User::where('username', $githubUser->nickname)->first();

        if ($user == null) {
            return $this->setupNewUser($githubUser);
        }

        return $user;
    }

    /**
     * Sets up a new user and profile.
     *
     * @param $githubUser
     * @return static
     */
    private function setupNewUser($githubUser)
    {
        $user = User::create([
            'username' => $githubUser->nickname,
            'email' => $githubUser->email,
            'avatar' => $githubUser->avatar,
        ]);

        $this->setupUserProfile($user);

        return $user;
    }

    /**
     * Set collaborators account
     * @param $githubUser
     * @return static
     */
    private function setupCollaborator($githubUser)
    {
        $user = User::where('username', $githubUser['login'])->first();

        if ($user != null) {
            return $user;
        }
        $user = User::create([
            'username' => $githubUser['login'],
            'email' => $githubUser['email'],
            'avatar' => $githubUser['avatar_url'],
        ]);

        $this->setupUserProfile($user);

        $this->mailer->sendInvitationToUser($user);

        return $user;
    }
    /**
     * Pulls in relevant information and sets up the new user.
     *
     * @param User $user
     */
    private function setupUserProfile(User $user)
    {
        //Get all the user's repos and create projects for them.
        $repositories = $this->github->api('user')->repositories($user->username);
        foreach ($repositories as $repo) {
            $project = Project::create([
                'name' => $this->humaniseName($repo['name']),
                'slug' => $repo['name'],
                'description' => $repo['description'],
                'user_id' => $user->id,
            ]);

            $this->getMilestonesForProject($project, $user);

            $this->getIssuesForProject($project, $user);

            $this->getCollaboratorsForProject($project, $user);

        }
        //commit feature as feature-sync-from-github
    }

    /**
     * Save the milestones for a particular project (repository).
     *
     * @param Project $project
     * @param User $user
     */
    private function getMilestonesForProject(Project $project, User $user)
    {
        //For each repo use milestones and issues to create tasks for them.
        $milestones = $this->github->api('issue')->milestones()->all($user->username, $project->slug);
        foreach ($milestones as $milestone) {
            $task = Task::create([
                'name' => $milestone['title'],
                'project_id' => $project->id,
                'assignee' => $user->id,
            ]);
        }
    }

    /**
     * Save the issues for a particular project (repository).
     *
     * @param Project $project
     * @param User $user
     */
    private function getIssuesForProject(Project $project, User $user)
    {
        //Foreach issue attach a user who owns the task.
        $issues = $this->github->api('issue')->all($user->username, $project->slug);
        foreach ($issues as $issue) {
            $task = Task::create([
                'name' => $issue['title'],
                'project_id' => $project->id,
                'user_id' => $user->id,
            ]);
        }
    }

    /**
     * Saves and invites the collaborators of a project.
     *
     * @param Project $project
     * @param User $user
     */
    private function getCollaboratorsForProject(Project $project, User $user)
    {
        //Get the collaborators of the repo and create accounts for them and invite them to the application using email.
        $this->github->authenticate(env('GITHUB_TOKEN'), null, Client::AUTH_HTTP_TOKEN);
        $collaborators = $this->github->api('repo')->collaborators()->all($user->username, $project->slug);

        foreach ($collaborators as $collaborator) {
            $details = $this->github->api('user')->show($collaborator['login']);
            $userCollaborator = $this->setupCollaborator($details);
            $project->collaborators()->attach($userCollaborator->id);
        }

    }

    /**
     * Cleans and humanises the repo name to a readable name.
     *
     * @param $name
     * @return string
     */
    private function humaniseName($name)
    {
        $name = str_replace('_', ' ', $name);
        $name = str_replace('-', ' ', $name);
        return ucwords($name);
    }
}