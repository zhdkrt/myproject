<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;

class CompanyPolicy
{
    public function update(User $user, Company $company): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->company && $user->company->id === $company->id;
    }
}