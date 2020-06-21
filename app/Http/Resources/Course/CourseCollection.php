<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseCollection extends JsonResource
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
            'imageURL' => $this->image,
            'count_content' => count($this->course_details),
            'href' => [
                'course-detail' => route('api.courses.show', $this->id),
            ],
        ];
    }
}
