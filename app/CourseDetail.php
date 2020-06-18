<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    protected $fillable = [
        'title', 'time', 'videoURL', 'desc', 'iscomplete', 'course_id',
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
}
