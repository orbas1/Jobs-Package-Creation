<?php

namespace JobsLaravelPackage\Policies;

use Illuminate\Contracts\Auth\Authenticatable;
use JobsLaravelPackage\Models\UserJob;

class UserJobPolicy
{
    public function updateStage(?Authenticatable $user, UserJob $application): bool
    {
        return $user?->getAuthIdentifier() === $application->opening?->user_id;
    }

    public function view(?Authenticatable $user, UserJob $application): bool
    {
        return $this->updateStage($user, $application) || $user?->getAuthIdentifier() === $application->user_id;
    }
}
