<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
