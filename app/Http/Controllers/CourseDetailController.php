<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseDetail;
use App\Http\Requests\CourseDetailStoreRequest;
use Illuminate\Http\Request;

class CourseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CourseDetailStoreRequest $request)
    {
        $validated = $request->validated();
        // dd($validated);
        CourseDetail::create($validated);

        return redirect()->back()
                        ->with('success','Course created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CourseDetail $courseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseDetail $courseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(CourseDetailStoreRequest $request, CourseDetail $courseDetail)
    {
        $validated = $request->validated();
        // dd($validated);
        $courseDetail->update($validated);

        return redirect()->back()
                        ->with('success','Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseDetail $courseDetail)
    {
        // dd($courseDetail);
        $courseDetail->delete();

        return redirect()->back()
                        ->with('success','Courses deleted successfully');
    }
}
