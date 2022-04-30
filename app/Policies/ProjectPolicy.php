<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Project $project)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }

    public function delete(User $user, Project $project)
    {
        return true;
    }

    public function restore(User $user, Project $project)
    {
        return $project->user_id === $user->id;
    }

    public function forceDelete(User $user, Project $project)
    {
        return true;
    }
}