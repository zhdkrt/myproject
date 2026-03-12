<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'position_name',
        'seniority',
    ];

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function desiredResumes()
    {
        return $this->hasMany(Resume::class, 'desired_position_id');
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }
}
