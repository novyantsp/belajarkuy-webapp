<?php

namespace App\Http\Controllers;

use App\CourseDetail;
use App\Course;
use App\Http\Resources\Course\CourseDetailCollection;
use App\Http\Resources\Course\CourseDetailResource;
use Response;
use Illuminate\Http\Request;

class CourseDetailAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        return CourseDetailCollection::collection($course->course_details);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, CourseDetail $list_course)
    {
        if ($list_course) {
            return new CourseDetailResource($list_course);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Course Not Found!',
                'data'    => ''
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, CourseDetail $list_course)
    {
        // $validated = $request->validated();
        // dd($list_course);
        $list_course->iscomplete = $request->get('iscomplete', $list_course->iscomplete);
        $list_course->save();
        // $courseDetail->update($validated);
        if ($list_course->save()) {
            return response()->json([
                'success' => true,
                'data'    => $list_course
            ], 404);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ERROR!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
