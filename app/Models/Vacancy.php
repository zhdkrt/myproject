<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'company_id',
        'category_id',
        'position_id',
        'title',
        'description',
        'salary_min',
        'salary_max',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
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
