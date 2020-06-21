<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseDetailCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->desc,
            'video' => $this->videoURL,
            'duration' => $this->time,
            'iscomplete' => $this->iscomplete,
            'href' => [
                'detail-list-course' => route('list-course.show', [$this->course_id, $this->id]),
            ],
        ];
    }
}
