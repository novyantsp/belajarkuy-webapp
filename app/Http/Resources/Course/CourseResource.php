<?php

namespace App\Http\Resources\Course;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'course_content' => $this->course_details,
        ];
    }
}
