<?php

namespace App\Policies;

use App\Models\ReportType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportTypePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ReportType $reportType): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ReportType $reportType): bool
    {
        return true;
    }

    public function delete(User $user, ReportType $reportType): bool
    {
        return true;
    }

    public function restore(User $user, ReportType $reportType): bool
    {
        return true;
    }

    public function forceDelete(User $user, ReportType $reportType): bool
    {
        return true;
    }
}