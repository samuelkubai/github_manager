<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Mass assignable fields.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'user_id'];

    /**
     * Links to the user the project belongs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Link to the collaborators of the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function collaborators()
    {
        return $this->belongsToMany('App\Collaborator', 'collaborators', 'project_id', 'user_id')->withTimestamps();
    }

    /**
     * Links to the tasks for the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
