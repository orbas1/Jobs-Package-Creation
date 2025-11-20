<?php

namespace JobsLaravelPackage\Policies;

use Illuminate\Contracts\Auth\Authenticatable;
use JobsLaravelPackage\Models\Opening;

class OpeningPolicy
{
    public function view(?Authenticatable $user, Opening $opening): bool
    {
        return true;
    }

    public function create(?Authenticatable $user): bool
    {
        return (bool) $user;
    }

    public function update(?Authenticatable $user, Opening $opening): bool
    {
        return $user?->getAuthIdentifier() === $opening->user_id;
    }

    public function delete(?Authenticatable $user, Opening $opening): bool
    {
        return $user?->getAuthIdentifier() === $opening->user_id;
    }
}
