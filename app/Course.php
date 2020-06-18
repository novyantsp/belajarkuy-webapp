<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'desc', 'image',
    ];

    public function course_details()
    {
        return $this->hasMany(CourseDetail::class,'course_id');
    }

    public function getProgress()
    {
        $totalProgress = $this->course_details()->count();
        $iscomplete = $this->course_details()->where('iscomplete', '1')->count();
        $progress = $iscomplete == 0 ? 0 : ($iscomplete/$totalProgress*100);
        return $progress;
    }
}
