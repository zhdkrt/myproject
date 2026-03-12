<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $fillable = [
        'resume_id',
        'position_id',
        'company_name',
        'start_date',
        'end_date',
        'description',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
