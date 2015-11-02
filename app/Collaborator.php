<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    /**
     * Mass assignable keys
     * @var array
     */
    protected $fillable = ['user_id', 'project_id'];


}
