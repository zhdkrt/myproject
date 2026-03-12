<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'user_id',
        'desired_position_id',
        'about_me',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function desiredPosition()
    {
        return $this->belongsTo(Position::class, 'desired_position_id');
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'resume_skills')->withTimestamps();
    }
}
