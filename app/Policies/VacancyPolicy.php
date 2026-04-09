<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;

class VacancyPolicy
{
    public function update(User $user, Vacancy $vacancy): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if (! $user->company) {
            return false;
        }

        return $user->company->id === $vacancy->company_id;
    }

    public function delete(User $user, Vacancy $vacancy): bool
    {
        return $this->update($user, $vacancy);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'employer' && $user->company);
    }
}